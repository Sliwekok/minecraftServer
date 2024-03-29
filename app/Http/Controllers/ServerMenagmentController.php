<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
Use App\User;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Facades\Storage;
use File;
use Response;
use Illuminate\Support\Facades\Hash;

class ServerMenagmentController extends Controller
{
    
    public function index(){

        $user = Auth::user()->name;

        $server = (DB::table('servers')->where('owner', $user)->get()->count() == 0) ? null : DB::table('servers')->where('owner', $user)->get();

        return view('settings.index', [
            'server' => $server,
        ]);

    }

    public function menagment(){

        $user = Auth::user()->name;
        if($this->hasServer($user) === false){
            return redirect('/settings/create');
        }

        return view('settings.menagment');

    }

    public function players(){

        $user = Auth::user()->name;
        if($this->hasServer($user) === false){
            return redirect('/settings/create');
        }

        return view('settings.users');

    }

    public function console(){

        $user = Auth::user()->name;
        if($this->hasServer($user) === false){
            return redirect('/settings/create');
        }

        $server = DB::table('servers')->where('owner', $user)->get();
        $messages = DB::table('servers')->get();

        return view('settings.console', [
            'messages'  => $messages,
            'server'    => $server,
        ]);
    }

    public function sendCommand(Request $request){

        $answer = $request->input('command');

        return $answer;

    }

    public function files(){

        $user = Auth::user()->name;
        if($this->hasServer($user) === false){
            return redirect('/settings/create');
        }

        return view('settings.files');

    }

    public function logs(){

        $user = Auth::user()->name;
        if($this->hasServer($user) === false){
            return redirect('/settings/create');
        }

        return view('settings.logs');

    }

    public function create(){

        $user = Auth::user()->name;
        if($this->hasServer($user) === true){
            return redirect('/settings');
        }

        return view('settings.create');

    }

    // function that creates server with user given data
    public function createPOST(Request $request){

        $user = Auth::user()->name;

        // need to trim "." from version here to check if it is integer
        $version = str_replace('.','',$request->input('version'));

        $validator = Validator::make($request->all(), [ 
            'serverName'        => 'required|max:64',
            'serverDescription' => 'max:128',
            'motdMessage'       => 'max:256',
            'maxPlayers'        => 'required|max:64|numeric',
            'difficulty'        => 'required|in:peaceful,easy,normal,hard',
            'isNether'          => 'required|in:true,false',
            'isHardcore'        => 'required|in:true,false',
            'pvpOn'             => 'required|in:true,false',
            'isPremium'         => 'required|in:true,false',
            'autokick'          => 'required|max:30|numeric',
        ]);

        $validatorVersion = Validator::make(['version' => $version],
        [
            'version'            => 'required|numeric|between:100,9999'
        ]);

        if( $validator->fails() || $validatorVersion->fails() ){
            $request->session()->flash('error', 'Sprawdź poprawność podanych danych');
            return back()->withInput($request->all());
        }

        // roll some random number for additional protection
        $server_data = [
            'name'          => $request->input('serverName'),
            'description'   => $request->input('serverDescription'),
            'motd'          => $request->input('motdMessage'),
            'version'       => $request->input('version'),
            'maxPlayers'    => $request->input('maxPlayers'),
            'difficulty'    => $request->input('difficulty'),
            'seed'          => $request->input('serverSeed'),
            'nether'        => $request->input('isNether'),
            'hardcore'      => $request->input('isHardcore'),
            'pvp'           => $request->input('pvpOn'),
            'premium'       => $request->input('isPremium'),
            'autokick'      => $request->input('autokick'),
            'owner'         => $user,
        ];

        // find free port to allow many connections to a single server
        $availablePort = $this->findFreePort();
        $server_data += [ 'port' => $availablePort ]; 
            
        // create directory with all generated files
        // path is: storage/app/servers/user_created/[username]/[serverName]
        $path = 'user_created/'.$user.'/'.$server_data['name'];
        
        // check if directory exists with the same server name
        if(!Storage::disk('servers')->exists($path)){
            Storage::disk('servers')->makeDirectory($path);
        }
        else{
            $request->session()->flash('error', "Nazwa jest już zajęta");
            return back()->withInput($request->all());
        }
        
        // create config file 
        $config = $this->createConfigFile($server_data, $path);
        $batch = $this->createBatch($server_data, $path);
        $moveServerFile = $this->moveServerFile($server_data['version'], $path);
        if(!$config || !$batch || !$moveServerFile){
            $request->session()->flash('error', "Nastąpił błąd z tworzeniem plików konfiguracyjnych");
            return back()->withInput($request->all());
        }
        

        // save in database
        if(!DB::table('servers')->insert($server_data)){
            $request->session()->flash('error', "Nastąpił błąd z bazą danych");
            return back()->withInput($request->all());
        }

        return Response::json($server_data);
        
    }

    public function action(){
        $user = Auth::user()->name;
        $server = DB::table('servers')->where('owner', $user);

        if($server->first()->status == 'online') $callback = $this->stopServer($user, $server);
        if($server->first()->status == 'offline') $callback = $this->startUpServer($user, $server);

        return $callback;
    }

    public function deleteServer(Request $request){
        $user = Auth::user()->name;
        if($this->hasServer($user) === false){
            return redirect('/settings/create');
        }

        $server     = DB::table('servers')->where('owner', $user);
        $serverName = $server->first()->name;
        $serverFiles= 'user_created/'.$user.'/'.$serverName;

        $deleteFiles = Storage::disk('servers')->deleteDirectory($serverFiles);
        $deleteFromDatabase = $server->delete();

        if(!$deleteFiles || !$deleteFromDatabase){
            $request->session()->flash('error', "Błąd z usuwaniem plików konfiguracyjnych");
            return back()->withInput($request->all());
        }

        $request->session()->flash('success', "Serwer został usunięty");
        return redirect('/settings');
    }

    // check if user already has some servers. implementation of all functions as a check out
    private function hasServer($user){
        $servers = DB::table('servers')->where('owner', $user)->get();

        if($servers->count() == 0){
        
            return false;

        }
        return true;
    }

    // start up server
    private function startUpServer($user, $server){

        $result = 0;
        $output = [];
        // $file = '/user_created/'.$user.'/'.$server->first()->name.'/start.bat';
        // $file = Storage::disk('servers')->url('user_created/'.$user.'/'.$server->first()->name.'/start.bat');
        // $file = Storage::disk('servers')->get('user_created/'.$user.'/'.$server->first()->name.'/start.bat');

        // absolute path to server start
        $path = "C:\Programy\Laragon\laragon\www\minecraftServer\storage\app\servers\user_created/".$user.'/'.$server->first()->name.'/server.jar';
        // $command = "java -Xms1024M -Xmx1536M -jar $path 2>&1";
        $command = "$path 2>&1";
        exec($command, $output, $result);
        if($result !== 0) {
            return var_dump($output);
        }
        else{
            // $server->update(['status' => 'online']);
            return('Serwer już działa!');
        }
        
        // $output = shell_exec($command);
        // if(!$output){
        //     return ("Problem z uruchomieniem serwera");
        // }
        // else{
        //     // $server->update(['status' => 'online']);
        //     return $output;
        // }
    }

    // stop server
    private function stopServer($user, $server){
        
        // the way proccess is names is always the same: owner.server_name
        $titledProccess = $server->first()->owner.$server->first()->name;
        $killCommand = "taskkill /IM $titledProccess /F 2>&1";
        $result = 0;
        $output = [];
        exec($killCommand, $output, $result);
        if($result != 0) {
            return var_dump($output);
        }
        else{
            $server->update(['status' => 'offline']);
            return('Serwer wyłączony');
        }  
    }

    // find free port to a server
    private function findFreePort(){

        $server = DB::table('servers');
        // set var as a port-checker, goes through each possible port in range 20k-30k 
        $i = 20000;

        while($i++){
            if( !$server->where('port', $i)->first() ) break;
            if( $i > 30000 ) break;
        }

        return $i;

    }

    // Get a requested MC server version and copy it to the server directory
    private function moveServerFile($version, $path){
        // find original server file
        $source = 'server_files/server-'.$version.'.jar';
        $move = Storage::disk('servers')->copy($source, $path.'/server.jar');
        if($move) return true;
        else return false;
    }

    // that function creates config file.
    private function createConfigFile($server_data, $path){
        $global_config = <<<EOD
            #Minecraft server properties
            #(timestamp of first initializing)
            enable-jmx-monitoring=false
            rcon.port=25575
            enable-command-block=false
            enable-query=false
            network-compression-threshold=256
            require-resource-pack=false
            max-tick-time=60000
            use-native-transport=true
            allow-flight=true
            broadcast-rcon-to-ops=true
            view-distance=10
            resource-pack-prompt=
            server-port={$server_data['port']}
            enable-rcon=false
            sync-chunk-writes=true
            op-permission-level=4
            prevent-proxy-connections=false
            resource-pack=
            entity-broadcast-range-percentage=100
            simulation-distance=10
            rcon.password=
            force-gamemode=false
            rate-limit=0
            white-list=false
            broadcast-console-to-ops=true
            spawn-npcs=true
            spawn-animals=true
            snooper-enabled=true
            function-permission-level=2
            text-filtering-config=
            spawn-monsters=true
            enforce-whitelist=false
            resource-pack-sha1=
            spawn-protection=16
            max-world-size=29999984
            gamemode=survival
            #here starts user customization 
            level-name={$server_data['name']}
            motd={$server_data['motd']}
            pvp={$server_data['pvp']}
            difficulty={$server_data['difficulty']}
            max-players={$server_data['maxPlayers']}
            allow-nether={$server_data['nether']}
            player-idle-timeout={$server_data['autokick']}
            hardcore={$server_data['hardcore']}
            #some menagment stuff
            server-ip=localhost
            online-mode=true
            enable-status=true
            query.port=25565.
            EOD;
            
            // create server.property file with config
            // also puts it in the right directory
            $path = $path.'/server.properties';
            $createFile = Storage::disk('servers')->put($path, $global_config);
            
            if(!$createFile){
                return false;
            }
            return true;
    }

    // here .bat files is created to allow starting up .jar server file
    private function createBatch($server_data, $path){
        $file = $path.'/start.bat';
        // it allows finding that exact server running
        $fileTitle =  $server_data['owner'].$server_data['name'];
        // bat file to run server. 1GB ram minimum, 1,5GB max
        $content = "title $fileTitle \njava -Xms1024M -Xmx1536M -jar server.jar 2>&1";
        $createFile = Storage::disk('servers')->put($file, $content);

        if(!$createFile){
            return false;
        }
        return true;
    }

}

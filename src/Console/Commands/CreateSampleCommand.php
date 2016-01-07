<?php
namespace Vr80s\LaravelRbac\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Composer;

class CreateSampleCommand extends Command {

    protected $files;

    protected $composer;

    protected $srcPath;

    protected $destPath;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'laravel-rbac:create-sample';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create sample Controllers for Laravel Rbac';

    public function __construct(Filesystem $files, Composer $composer){
        parent::__construct();

        $this->files = $files;
        $this->composer = $composer;

    }

    /**
     * Execute the console command.
     *
     * @return bool
     */
    public function fire(){

        $this->srcPath = [
            'migrations'    =>  '',   //
            'controllers'   =>  realpath(__DIR__ .'/../../Http/Controllers/'),
            'middleware'    =>  '',
            'views'         =>  realpath(__DIR__ .'/../../../resources/'),
            'public'         =>  realpath(__DIR__ .'/../../../public/'),
        ];

        $this->destPath = [
            'migrations'    =>  base_path('database/migrations'),
            'controllers'   =>  app_path('Http/Controllers/Rbac/'),
            'middleware'    =>  app_path('Http/Controllers/Middleware/'),
            'views'         =>  base_path('resources/views/vr80s/'),
            'public'         =>  base_path('public/vr80s/'),
        ];


        $this->copyMigrations();
        $this->copyControllers();
        $this->copyMiddleware();
        $this->copyViews();
        $this->copyPublic();

        dump($this->destPath);

        $this->info($this->name.' is finished.');

        return true;
    }

    private function copyMigrations(){

    }

    private function copyControllers(){
        $srcPath = $this->srcPath['controllers'];
        $destPath = $this->destPath['controllers'];

        $this->copyDir($srcPath, $destPath);
    }

    private function copyMiddleware(){

    }

    private function copyViews(){
        $srcPath = $this->srcPath['views'];
        $destPath = $this->destPath['views'];

        $this->copyDir($srcPath, $destPath);
    }

    private function copyPublic(){
        $srcPath = $this->srcPath['public'];
        $destPath = $this->destPath['public'];

        $this->copyDir($srcPath, $destPath);
    }

    /**
     * copy $source directory to $destination directory
     * @param $source
     * @param $destination
     */
    private function copyDir($source, $destination) {
        if($this->files->exists($destination)){
            $this->warn('Destination directory already exists');
        }else{
            $res = $this->files->copyDirectory($source, $destination);
            if(!$res){
                $this->warn('Source : ' . $source);
                $this->warn('Destination : ' . $destination);
                $this->warn('copy failed');
            }
        }
    }



}
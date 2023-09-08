<?php

namespace Devdojo\Genesis\Console\Commands;

use File;
use ZipArchive;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Foundationapp\PowerUps\Helpers\PowerUpHelper;

class PowerupInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'powerup:install {repo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install a Power-up from a Github repository';

    /**
     * Execute the console command.
     */
    public function handle()
    {   
        $repo = $this->argument('repo');
        // if the $repo contains http or https, show an error message to the user that they need to use the format: vendor/repo
        if(Str::contains($repo, 'http') || Str::contains($repo, 'https')){
            $this->error('Please use the format: vendor/repo');
            return;
        }

        // Separate the vendor/repo by exploding the string from the / character
        $vendorRepo = explode('/', $repo);
        // if $vendorRepo offset 0 and 1 do not exist show error to user that they need to use the format: vendor/repo
        if(!isset($vendorRepo[0]) || !isset($vendorRepo[1])){
            $this->error('Please use the format: vendor/repo');
            return;
        }

        $this->cleanTheTempFolder();
        
        $vendor = $vendorRepo[0];
        $repo = $vendorRepo[1];

        $repoSlug = Str::snake($repo, '-');
        $repoCamelCase = ucfirst(Str::camel($repoSlug));
        
        $zipURL = 'https://github.com/' . $vendor . '/' . $repo . '/zipball/main';

        $zipResponse = Http::get($zipURL);
        Storage::put('powerup-tmp/' . $repoSlug . '.zip', $zipResponse->body());

        $zip = new ZipArchive;

        $res = $zip->open( storage_path('app/powerup-tmp/' . $repoSlug . '.zip') );

        if ($res === TRUE) {
            $zip->extractTo(storage_path('app/powerup-tmp/'));
            $unzippedFolderName = trim($zip->getNameIndex(0), '/');
            $zip->close();

            $zipFolderLocation = 'app/powerup-tmp/' . $unzippedFolderName;

            $this->deleteUnusedFiles($zipFolderLocation);
            
            // move over all the power-up files
            $filesystem = new Filesystem();
            $filesystem->copyDirectory(storage_path($zipFolderLocation), base_path());

            // rename the src folder to the CamelCase version of the repo name, example hello-world becomes HelloWorld
            //rename(storage_path($zipFolderLocation . '/src'), storage_path($zipFolderLocation . '/' . $repoCamelCase));

            // before we move to the destination folder we want to get the Name and Description from the component.json file if it exists
            //[$name, $description] = $this->getPowerUpComponentJson($zipFolderLocation, $repoCamelCase);

            // Move the RepoName (ex: HelloWorld) into the PowerUps/Components folder
            //File::move(storage_path($zipFolderLocation . '/' . $repoCamelCase), app_path('PowerUps/Components/' . $repoCamelCase) );

            // PowerUpHelper::installPowerUpInComponentsJson(
            //         $repoSlug, 
            //         $repoCamelCase, 
            //         '',
            //         $version, 
            //         'https://github.com/' . $vendor . '/' . $repo
            //     );

            $this->info('Successfully Installed');
        } else {
        
            $this->error('Error: ' . $res);
            
        }

        // dd($zipBallContents);

        // store the zipball contents in the temp directory
        //$zipBallPath = storage_path('app/temp/' . $repo . '.zip');



        // dd($response);
        //dd($response->json());


        
    }

    private function deleteUnusedFiles($zipFolderLocation){
        $ignoreFolder = storage_path($zipFolderLocation . '/_ignore');
        if (File::exists($ignoreFolder)){
            File::deleteDirectory($ignoreFolder);
        }

        $readmeFile = storage_path($zipFolderLocation . '/README.md');
        if(File::exists($readmeFile)){
            File::delete($readmeFile);
        }

        $powerupFile = storage_path($zipFolderLocation . '/powerup.json');
        if(File::exists($powerupFile)){
            File::delete($powerupFile);
        }
    }

    private function getPowerUpComponentJson($zipFolderLocation, $repoCamelCase){
        if(file_exists(storage_path($zipFolderLocation . '/component.json'))){
            $componentJson = json_decode(file_get_contents(storage_path($zipFolderLocation . '/component.json')), true);
            return [$componentJson['name'], $componentJson['description']];
        }

        return [$repoCamelCase, ''];
    }

    private function cleanTheTempFolder(){
        $file = new Filesystem;
        $file->cleanDirectory(storage_path('app/powerup-tmp/'));
    }
}

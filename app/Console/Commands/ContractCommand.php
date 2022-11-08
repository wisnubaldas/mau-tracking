<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Pluralizer;
use Illuminate\Filesystem\Filesystem;

use App\Driver\MakeStub;
class ContractCommand extends Command
{
    use MakeStub;
    protected $stub_name;
    protected $name_space;
    protected $path_nya;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:contract {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bikin contract interface';

    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
        $this->stub_name = 'interface.stub';
        $this->name_space = 'App\\Contract';
        $this->path_nya = base_path('app/Contract');
    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path = $this->getSourceFilePath();
        $this->makeDirectory(dirname($path));
        $contents = $this->getSourceFile();
        if (!$this->files->exists($path)) {
            $this->files->put($path, $contents);
            $this->info("File : {$path} created");
        } else {
            $this->info("File : {$path} already exits");
        }

        return Command::SUCCESS;
    }
}

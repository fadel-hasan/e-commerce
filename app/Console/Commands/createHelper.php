<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class createHelper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:helper {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new helper file.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path('Helpers\\' . $name . '.php');

        if (!is_dir(app_path('Helpers'))) {
            mkdir(app_path('Helpers'));
        }

        if (!file_exists($path)) {
            $content = $this->getStubContent();
            file_put_contents($path, $content);
        }

        $this->info('Helper file created successfully.');
    }



    protected function getStubContent()
    {
        $stubContent = "<?php\n\n";
        $stubContent .= "namespace App\\Helpers;\n\n";
        $stubContent .= "use Illuminate\Support\Facades\Request;\n";
        $stubContent .= "use Carbon\Carbon;\n\n";
        $stubContent .= "class {{name}}\n";
        $stubContent .= "{\n";
        $stubContent .= "    // Write your helper functions here...\n";
        $stubContent .= "}\n";

        $stubContent = str_replace('{{name}}', $this->argument('name'), $stubContent);

        return $stubContent;
    }

}

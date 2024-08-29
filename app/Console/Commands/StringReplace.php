<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StringReplace extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:string_replace {pattern} {args*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A Laravel command to replace strings represented by delimiter with arguments';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pattern = $this->argument('pattern');
        $args = $this->argument('args');

        // validation of input 
        $placeholderPattern = "{(\d+)}";
        $placeholderCount = preg_match_all($placeholderPattern, $pattern);;
        $argsCount = count($args);

        if ($argsCount < $placeholderCount) {
           throw new \Exception("Few arguments: expected $placeholderCount args got $argsCount.");
        }
    
        $result = $pattern;

        foreach ($args as $index => $arg) {
     
            
            if (preg_match("{(.*)}", $arg)) {
              $arg =   str_replace("{","OPC",$arg);
              $arg =   str_replace("}","CLC",$arg);
           
            }
           
            $result=  str_replace("{".$index."}", $arg,$result, );
        }
     
        $result = str_replace("OPC","{",$result);
        $result = str_replace("CLC","}",$result);

        echo("Input:"."\n\tPattern: $pattern\n\tArgs: ".json_encode($args)."\n\n");
        echo("Output: ".$result."\n");
    }


    
}

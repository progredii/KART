<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ArraySum extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:array_sum {arr}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A Laravel command that will calculate the sum of an array given as input';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $arr = $this->argument('arr');


      $res =   static::flattenArray(json_decode($arr));
    
         echo("Output: ".array_sum($res)."\n");
     
    }

    static function flattenArray(array $arr): array {
   
        $result = [];
        foreach ($arr as  $value) {
           if (! is_array($value)) {
            array_push($result,$value);
           }else{
           $result = array_merge($result,static::flattenArray($value));
           }
        }
        return $result;
    }


  
}

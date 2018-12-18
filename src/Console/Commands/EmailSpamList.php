<?php

namespace Maksim_N\EmailSpamList\Console\Commands;

use Illuminate\Console\Command;
use Maksim_N\EmailSpamList\Models\EmailSpamList as EmailList;

class EmailSpamList extends Command
{

    protected $allowedSort = ['ASC', 'DESC'];
    protected $strSort = "";
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email_spam:list {--sort=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show full spam email list';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //-- Check and validate --sort option
        if (!empty($this->option('sort'))) {
            if (in_array(strtoupper($this->option('sort')), $this->allowedSort)) {
                $this->strSort=strtoupper($this->option('sort'));
            } else {
                $this->error('Not allowed type of {--sort} option. Allowed values are: ' . implode(",", $this->allowedSort));
                return;
            }
        }


        if(empty($this->strSort)){
            $emailSpamList = EmailList::all();
        }else{
            $emailSpamList = EmailList::where('id','>',0)->orderBy('email',$this->strSort)->get();
        }

        if (count($emailSpamList) > 0) {
            $intCount = 1;
            foreach ($emailSpamList as $item) {
                $this->info($intCount . ". " . $item->email);
                $intCount++;
            }

        } else {
            $this->error('Email spam list is EMPTY now!');
        }

    }
}

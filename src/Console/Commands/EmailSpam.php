<?php

namespace Maksim_N\EmailSpamList\Console\Commands;

use Illuminate\Console\Command;
use Maksim_N\EmailSpamList\Models\EmailSpamList;
use Validator;

class EmailSpam extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email_spam:email {email} {--remove}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add email to spam list';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function validateEmail(string $strEmail):bool {
        $validator = Validator::make([
            'email' => $strEmail,
        ], [
            'email' => ['required', 'email'],
        ]);
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return false;
        }else{
            return true;
        }
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        if($strEmail = $this->argument('email')){
            $emailSpamList=EmailSpamList::where('email',$strEmail)->first();
            if($this->validateEmail($strEmail)){

                if( $this->option('remove')) {
                    if($emailSpamList==null){
                        $this->error("Provided email " . $strEmail . " does not exist the spam list");
                        return;
                    }
                    EmailSpamList::where([
                        'email' => $strEmail
                    ])->delete();
                    $this->info("Email " . $strEmail . " was successfully deleted from the spam list");
                    return;
                }


                if($emailSpamList==null){
                        EmailSpamList::create([
                            'email' => $strEmail
                        ])->save();
                        $this->info("Email " . $strEmail . " was successfully added in the spam list");
                }else{
                    $this->error("Email ".$strEmail." already exists in spam list and won't be overwritten");
                }
            }
        }else{
            $this->error("Parameter {email} can not be empty");
        }
    }
}

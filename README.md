# Laravel_Package_Email_Spam_List
Laravel custom composer package for easy and convenient way to handle spam email list

### How To Insatall

### 1) Add '"maksim_n/email_spam_list": "dev-master"' to your main 'composer.json' file:
### 2) Run following command:
```
composer update
```
### 3) Update migrations:
```
php artisan migrate
```

### How To Use

### 1) Use following command in order to 'ADD' email in the spam list:
```
php artisan email_spam:email example@gmail.com
```

### 2) Use following command in order to 'DELETE' email in the spam list:
```
php artisan email_spam:email example@gmail.com --remove
```

### 3) Use following command in order to see 'LIST' of emails in the spam list:
```
php artisan email_spam:list
```
### 4) Use following command in order to see 'LIST' of emails in the spam list with 'REQUIRED SORT':
```
php artisan email_spam:list --sort=ASC
php artisan email_spam:list --sort=DESC
```

<?php

class Form{

    public static function createRegisterForm(){
        echo self::formRegisterStart();
        echo self::formTitle('Create new acccount');
        echo self::createUsernameInput();
        echo self::createEmailInput();
        echo self::createPasswordInput();
        echo self::createSubmitButton('Create');
        echo self::formEnd();
    }

    public static function createLoginForm(){
        echo self::formLoginStart();
        echo self::formTitle('Log in');
        echo self::createEmailInput();
        echo self::createPasswordInput();
        echo self::createSubmitButton('Login');
        echo self::formEnd();
    }

    private static function formRegisterStart(){
        return '
        <div class="font-sans min-h-screen antialiased bg-gray-900 pt-24 pb-5">
        <div class="flex flex-col justify-center sm:w-96 sm:m-auto mx-5 mb-5 space-y-8">
        <form @submit.prevent="registerAction()">
        <div class="flex flex-col bg-white p-10 rounded-lg shadow space-y-6">
        ';
    }

    private static function formLoginStart(){
        return '
        <div class="font-sans min-h-screen antialiased bg-gray-900 pt-24 pb-5">
        <div class="flex flex-col justify-center sm:w-96 sm:m-auto mx-5 mb-5 space-y-8">
        <form action="login-action.php" method="post">
        <div class="flex flex-col bg-white p-10 rounded-lg shadow space-y-6">
        ';
    }

    private static function formEnd(){
        return '
            </div>
            </form>
            <div class="flex justify-center text-gray-500 text-sm">
            <p>&copy;2021. All right reserved.</p>
            </div>
        </div>
        </div>
        ';
    }

    private static function formTitle($title){
        return '
        <h1 class="font-bold text-xl text-center">'.$title.'</h1>
        ';
    }

    private static function createUsernameInput(){
        return '
        <div class="flex flex-col space-y-1">
        <input type="text" name="username" x-model="username" class="border-2 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400 focus:shadow" placeholder="Username" />
         </div>
        ';
    }

    private static function createEmailInput(){
        return '
        <div class="flex flex-col space-y-1">
            <input type="text" name="email"  x-model="email" class="border-2 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400 focus:shadow" placeholder="Email" />
          </div>
        ';
    }

    private static function createPasswordInput(){
        return '
        <div class="flex flex-col space-y-1">
        <input type="password" name="password"  x-model="password" class="border-2 rounded px-3 py-2 w-full focus:outline-none focus:border-blue-400 focus:shadow" placeholder="Password" />
         </div>
        ';
    }

    private static function createSubmitButton($title){
        return '
        <div class="flex flex-col-reverse sm:flex-row sm:justify-between items-center">
        <a href="#" class="inline-block text-blue-500 hover:text-blue-800 hover:underline">Have an account? Loggin here</a>
        <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-2 rounded focus:outline-none shadow hover:bg-blue-700 transition-colors">'.$title.'</button>
        </div>
        ';
    }


}


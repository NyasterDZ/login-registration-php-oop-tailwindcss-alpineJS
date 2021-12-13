<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.7.0/dist/cdn.min.js"></script>

</head>
<body>
  
        
     <div x-data="
        {
            username: '',
            email: '',
            password:'',
            error :'',
            showModal: false,
            registerAction(){
                fetch('http://localhost/phpoop/register.php',{
                    method:'POST',
                    headers : {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        username: this.username,
                        email: this.email,
                        password: this.password
                    }) 
                })
                .then(response => response.json())
                .then(result => {
                    this.error = result
                    this.showModal = true
                })
            }
        }
     ">
          <?php
            require "inc/classes/Form.php";
            Form::createRegisterForm();
        ?>

        <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="showModal" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': showModal }">
			
            <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" x-show="showModal" @click.away="showModal = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
      
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Status</p>
                    <div class="cursor-pointer z-50" @click="showModal = false">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                        </svg>
                    </div>
                </div>

                <!-- content -->
                <template x-if="error['error']">
                    <template x-for="e in error['error']">
                        <p class="text-red-900 font-bold" x-text="e"></p>
                    </template>
                </template>

                <template x-if="error['ok']">
                    
                        <p class="text-green-900 font-bold" x-text="error['ok']"></p>
                    
                </template>
                
                      
           </div>
        </div>
     </div>   
</body>
</html>
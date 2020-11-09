<?php
session_start();
$err = "";
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['method']) && $_GET['method'] == 'add'){
echo "here";
    if(isset($_SESSION['student_data'][$_POST['roll_no']]) && !empty($_SESSION['student_data'][$_POST['roll_no']])){
        $err="Data already exist";
    }else{
    
    $_SESSION['student_data'][$_POST['roll_no']]['roll_no'] = $_POST['roll_no'];
    $_SESSION['student_data'][$_POST['roll_no']]['name'] = $_POST['name'];
    $_SESSION['student_data'][$_POST['roll_no']]['cgpa'] = $_POST['cgpa'];
    
}

}


if(isset($_GET['method']) && $_GET['method'] == 'delete'){
    
    unset($_SESSION['student_data'][$_GET['id']]['roll_no']);
    unset($_SESSION['student_data'][$_GET['id']]['name']);
    unset($_SESSION['student_data'][$_GET['id']]['cgpa']);
    unset($_SESSION['student_data'][$_GET['id']]);

}

if(isset($_GET['method']) && $_GET['method'] == 'update' && $_SERVER['REQUEST_METHOD'] == 'POST'){
    echo "dfgdgh";

    if(isset($_SESSION['student_data'][$_GET['id']])){
    $_SESSION['student_data'][$_GET['id']]['name'] = $_POST['name'];
    $_SESSION['student_data'][$_GET['id']]['cgpa'] = $_POST['cgpa'];


    header("Location:http://localhost/PHPTutorials/index.php");
    }
}




?>





<html>

<head>
    <title>HEllo Tuts</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
</head>

<body>
    <nav class="width-full px-6 py-4 bg-black">
        <div class="flex">

            <div class="left">

                <h1 class="font-bold text-white text-2xl">W3Gym</h1>

            </div>

            <div class="ml-auto">

                <div class="text-white mt-1 cursor-pointer">
                    Ask Something
                </div>

            </div>


        </div>
    </nav>

    <div class="">

        <h1 class="text-center text-4xl mb-8">Student Record Entry</h1>

        <div class="width-full">

            <div class="flex mx-8">

                <div class="">Add Record: </div>

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>?method=add" method="POST">

                    <div class="flex">

                        <div class="mx-12">
                            <label for="RollNo">Roll No: </label>
                            <input type="text" placeholder="Enter Roll no" class="rounded px-1 py-1 bg-gray-300 shadow outline-none" name="roll_no">
                        </div>


                        <div class="mx-12">
                            <label for="RollNo">Name: </label>
                            <input type="text" placeholder="Name" class="rounded px-1 py-1 bg-gray-300 shadow outline-none" name="name">
                        </div>


                        <div class="mx-12">
                            <label for="RollNo">CGPA: </label>
                            <input type="text" placeholder="Enter CGPA" class="rounded px-1 py-1 bg-gray-300 shadow outline-none" name="cgpa">
                        </div>

                        <div class="mb-8">
                        <input type="submit" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-1 px-4 border border-gray-400 rounded shadow outline-none cursor-pointer" value="Add!">
                        </div>

                    </div>

                    


                </form>

            </div>

        </div>


        <?php if(isset($_SESSION['student_data']) && !empty($_SESSION['student_data'])) : ?>
        <div class="flex mx-12 width-full">
        
            <div class="flex mx-auto">
            
            <div class="width-3/5 py-4 px-4">

                <ul>
                <?php if(isset($_SESSION['student_data'])) : ?>
                    <?php foreach($_SESSION['student_data'] as $datas => $data) : ?>
                


                <li class="my-2">
                    
                        <div class="flex">
        
                        <div class="px-2 py-1 bg-black rounded-lg text-white mx-2 my-auto"><?php echo $data["roll_no"]; ?></div>
                        <div class="px-2 py-1 bg-black rounded-lg text-white mx-2"><?php echo $data["name"]; ?> | <?php echo $data["cgpa"]; ?></div>
                        <div class="flex px-2 py-1 bg-black rounded-lg text-white ml-auto">
                        
                        <div class="mx-2 my-auto cursor-pointer"><a href="?method=update&&id=<?php echo $data["roll_no"]; ?>"><i class="fa fa-edit"></i></a></div>
                        <div class="mx-2 my-auto cursor-pointer"><a href="?method=delete&&id=<?php echo $data["roll_no"]; ?>"><i class="fa fa-trash-alt"></a></i></div>
                        
                        </div>
                        
                        </div>
                        
                        </li>

                        <?php endforeach ?>
                        <?php endif ?>
                
                </ul>

            
            </div>

            <?php if(isset($_SESSION['student_data']) && isset($_GET['method']) && $_GET['method'] == 'update') : ?>


        <div class="width-2/5 px-4 ml-24">
            <span class="text-center mb-1">Update Record</span>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>?method=update&&id=<?php echo $_SESSION['student_data'][$_GET['id']]['roll_no']; ?>" method="POST">
            
            <div class="my-4">
            
            <label for="">Roll No: </label>
            <input type="text" value="<?php echo $_SESSION['student_data'][$_GET['id']]['roll_no']; ?>" class="rounded px-1 py-1 outline-none" name="roll_no" disabled>
            
            </div>

            <div class="my-8">
            
            <label for="">Name: </label>
            <input type="text" value="<?php echo $_SESSION['student_data'][$_GET['id']]['name']; ?>" class="rounded px-1 py-1 bg-gray-300 shadow outline-none" name="name">
            
            </div>


            <div class="my-8">
            
            <label for="">CGPA: </label>
            <input type="text" value="<?php echo $_SESSION['student_data'][$_GET['id']]['cgpa']; ?>" class="rounded px-1 py-1 bg-gray-300 shadow outline-none" name="cgpa">
            
            </div>

            <input type="submit" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-1 px-4 border border-gray-400 rounded shadow outline-none cursor-pointer float-right" value="Update"/>
            
            
            </form>

            </div>
            <?php endif ?>

            </div>
        
        </div>

        <?php else : ?>

        <h1 class="text-center text-gray-400 text-4xl">No Record found.... :(</h1>
        
        <?php endif ?>

    </div>
</body>

</html>
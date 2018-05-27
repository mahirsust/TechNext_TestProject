<!DOCTYPE html>
<html>
<head>
    <title>Vue Data</title>
    <link rel="shortcut icon" type="image/png" href="img.ico">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <style>
        .content {
            padding-top: 10%;
            margin-left: 31%;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <img src="{{url('images/logo/images.png')}}" width="30" height="30" alt="">
        <a class="navbar-brand" href="{{url('/')}}">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <div id="app" class="container">
        
        <div class="row">
            <div class="col-md-4 col-md-offset-4 content">
                <h3 class="text-center">Total Marks</h3>

                <form @submit.prevent='addSubject'>
                    <input class="form-control" v-model="newSubject">
                </form>
                <hr>
                <ul class="list-group">
                    <li v-for="(subject, index) in subjects" :key="index" class="list-group-item">
                        @{{subject.name}} - <input v-model="subject.number">
                        <button class="btn btn-sm btn-danger" @click="removeSubject(index)">
                            remove
                        </button>
                    </li>
                    <li class="list-group-item"> Total - @{{total}}</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        new Vue({
            el: '#app',
            data:{
                subjects:[
                    {name:'General Math', number:98},
                    {name:'Biology', number:97},
                    {name:'Higher Math', number:96},
                ],
                newSubject: ''
            },
            computed:{
                total(){
                    var total = 0
                    this.subjects.forEach(subject=>{
                        total+=parseFloat(subject.number)
                    })
                    return total
                }
            },
            methods:{
                addSubject(){
                    this.subjects.push({
                        name: this.newSubject,
                        number: 40
                    })
                },
                removeSubject(index){
                    this.subjects.splice(index, 1)
                }
            }
        })
    </script>
</body>
</html>
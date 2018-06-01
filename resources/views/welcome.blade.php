<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.Laravel = { csrfToken: '{{ csrf_token() }}' }
    </script>
    <title>Vue Js</title>
    <link rel="shortcut icon" type="image/png" href="img.ico">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-vue@2.0.0-rc.11/dist/bootstrap-vue.common.min.js"></script> -->
    <link href="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css" rel="stylesheet"/>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" >
    <!-- <style>
        .content {
            padding-top: 5%;
            margin-left: 31%;
        }
    </style> -->
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <img src="{{url('images/logo/images.png')}}" class="rounded" width="30" height="30" alt="">
        <a class="navbar-brand" href="{{url('/')}}" style="margin-left: 10px;">Vue js</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div id="app" class="container" style="margin-top: 20px;">
        
        <div class="row">
            <div class="col-md-12 content">
                <h3 class="text-center">Data Table</h3>

                <form @submit.prevent='addSubject' class="form-inline" style="padding-left: 300px; margin-top: 30px;">
                    {{csrf_field()}}
                  <div class="form-group mb-2">
                    <label for="subject" class="sr-only">Subject</label>
                    <input required type="text" class="form-control" name="subject" id="subject" v-model="newSubject" placeholder="Mathematics">
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="mark" class="sr-only">Marks</label>
                    <input required type="text" class="form-control" name="mark" id="mark" v-model="newNumber" placeholder="98">
                  </div>
                  <button class="btn btn-success mb-2" type="submit">Add</button>
                </form>
                <hr>

                <table class="table">
                  <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Marks</th>
                        <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(subject, index) in subjects" :key="index" v-cloak>
                        <th scope="row">@{{index+1}}</th>
                        <td>@{{subject.name}}</td>
                        <td>@{{subject.number}}</td>
                        <td>
                            <!-- <button class="btn btn-sm btn-danger" @click="removeSubject(index)">
                                Delete
                            </button> -->
                            <b-btn @click="removeSubject(subject.id)"  class="btn btn-sm btn-danger">
                                Delete
                            </b-btn>
                            <b-btn v-b-modal="modalId1(index)" title="Edit Data"
                             class="btn btn-sm btn-primary"  style="margin-left: 20px;">
                                Edit
                            </b-btn>
                            
                            <!-- Edit Modal Component -->
                            <b-modal :id="'modal1' + index" :key="index" ref="modal" title="Edit Data"
                                @ok="saveAction(subject.id)">
                                <b-form @submit.stop.prevent="editSubject(subject.id)" method="post">
                                    {{csrf_field()}}
                                    <b-form-group id="SubjectInputGroup1" label="Subject:" 
                                    label-for="SubjectInput">
                                        <b-form-input id="SubjectInput" name="editsubject" type="text" 
                                        v-model="editsubjectdata"
                                            required :value="subject.name">
                                        </b-form-input>
                                    </b-form-group>
                                    <b-form-group id="NumberInputGroup2" label="Number:" label-for="NumberInput">
                                        <b-form-input id="NumberInput" name="editnumber" type="text" 
                                        v-model="editnumberdata" 
                                            required :value="subject.number">
                                        </b-form-input>
                                    </b-form-group>
                                </b-form>
                            </b-modal>
                        </td>
                    </tr>
                  </tbody>
                </table>

                <div class="alert alert-success text-center" role="alert" v-cloak>
                  <h5 style="color: #000">Total Marks - @{{total_number}}</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
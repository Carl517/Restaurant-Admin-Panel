@extends('admin.main')
@section('content')     
    <div class="page-container-1 padding" id="page-container">
        <div class="page-title padding pb-0 ">
            <h2 class="text-md mb-0" style="padding-bottom: 35px;">User         
            
            <a href="{{ url('user/add') }}" class="btn btn-primary" style="float: right;">Add User</a>         
            
            <!-- @if($page != "all")
                
            @endif
            <a href="{{ url('import/index')}}" class="btn btn-primary" style="float:right;margin-right: 20px;"> Import </a>
            <a href="{{ url('import/export')}}" class="btn btn-primary" style="float:right;margin-right: 20px;"> Export </a>
            </h2> -->
        </div>

        <div class="padding card pt-5">
            <div class="table-responsive">
                
                <!-- <table id="datatable" class="table table-theme table-row v-middle" data-plugin="dataTable" style="margin-top: -15px;"> -->

                <table class="table table-theme v-middle" data-plugin="bootstrapTable"
                    id="table"
                    data-toolbar="#toolbar"
                    data-search="true"
                    data-search-align="left"
                    data-show-columns="true"
                    data-show-export="false"
                    data-detail-view="false"
                    data-mobile-responsive="true"
                    data-pagination="true"
                    data-page-list="[10, 25, 50, 100, ALL]"
                    >
                    
                    <thead>
                        <tr>
                            <th><span class="text-muted">Photo</span></th>
                            <th><span class="text-muted">Name</span></th>
                            <th><span class="text-muted">Email</span></th>
                            <th><span class="text-muted">Role</span></th>
                            <th><span class="text-muted">Created</span></th>
                            <th><span class="text-muted">Action</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>      
                                @if (strpos($user->image, 'png') !== false || strpos($user->image, 'jpg') !== false)                                    
                                    <img src="{{  url($user->image) }}" style="width:50px;height:50px;"/>
                                @else                                    
                                @endif

                                
                                </td>

                                <td>
                                {{$user->name}}
                                </td>
                                <td>
                                {{$user->email}}
                                </td>    
                                <td>
                                    @switch($user->role)
                                        @case(0)
                                            Admin
                                            @break
                                        @case(1)
                                            Manager
                                            @break
                                        @case(3)
                                            Client
                                            @break                                                                        
                                        @default
                                            <span>Client</span>
                                    @endswitch
                                </td>                                                         

                                <td>
                                {{$user->created_at}}
                                </td>
                                <td>
                                    <div class="row mr-3" style="">
                                    <a href="{{ url('user/edit', $user->id)}}" class="btn btn-primary mr-3" >Edit</a>                                    
                                    <button onclick="deleteUser({{$user->id}})" class="btn btn-primary" data-toggle="modal" data-target="#m">Delete</button>
                                    </div>                                    
                                </td>
                            </tr>
                        
                        @endforeach
                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- modal -->
<div id="m" class="modal" data-backdrop="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Are you sure to execute this action?</h5>
        </div>
        <!-- <div class="modal-body text-center p-lg">
        <p></p>
        </div> -->
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
        <button id="delBtn" type="button" class="btn btn-primary delBtn" data-dismiss="modal">Yes</button>
        </div>
    </div><!-- /.modal-content -->
    </div>
</div>
@stop


@section('script')
<script type="text/javascript">   
    $(document).ready(function() {        
    });

    var deleteId = "";
    function deleteUser(id){
        deleteId = id;
    }
    $("#delBtn").click(function(){    
        var id = deleteId;
        //var request = $.get('{{ URL::to('admin/deleteUser')}}' + "?id=" + id);
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        $.ajax({
          type: 'POST',
          data: { id:id},
          url: "{{ URL::to('api/deleteUser')}}",
          success: function(result) {     
                var res = result.results;
                if(res == 200){
                    location.reload();
                }else{
                    alert("Failed");
                }
          }

        });
    });             
</script>

@stop
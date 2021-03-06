@extends('admin.main')
@section('content')

<div class="page-container">

    <div class="page-container-1" id="page-container">
        <div class="page-title padding pb-0 ">
            <h2 class="text-md mb-0">Add Notification
            <a href="{{ url('notification/list') }}" class="btn btn-primary" style="float: right;color: white;">Back</a>
            </h2>
            
        </div>        
    <div class="padding">

    <div class="tab-content mb-4">
        <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab">

            <form  data-plugin="parsley" data-option="{}"  method="post" action="{{ url('notification/add') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <input type="text" name="title" class="   form-control" placeholder="Title"  required="required">
                </div>
                <div class="form-group">
                    <textarea type="text" name="description" class="   form-control"  placeholder="Description"   required="required"> </textarea>
                </div>
                           
                <div class="form-group">
                    <input type="text" name="url" class="  form-control" placeholder="Url"    required="required">
                </div>
                                              
                
                <div class=" form-group" style="padding: 0px;">                    
                    <button class="btn btn-primary" style="float: right;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('script')
<script src="https://unpkg.com/imask"></script>
<script type="text/javascript">   
    $(document).ready( function() {    
        var phoneMask = IMask(
        document.getElementById('office_num'), {
            mask: '000-000-0000'
        });

        var phoneMask = IMask(
        document.getElementById('home_num'), {
            mask: '000-000-0000'
        });
        
    });
</script>

@stop





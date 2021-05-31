
@extends('admin.layouts.master')

@section('head', 'Members')

@section('content')



<style>

.box{
 border: 2px solid #237ef7;
  
  display: none;
 
  left: 50%;
  margin-left: -200px;
  opacity: 0;
  position: fixed;
  top: 4%;
  z-index: 51; width: 400px;
  
  -moz-border-radius: 2px;
  -webkit-border-radius: 2px;
  border-radius: 2px;  overflow-y: scroll;
  background: #ffffff;
    padding: 20px; height: auto; padding-bottom: 20px;
}

.backDrop{
  background-color: #000;
  display: none;
  filter: alpha(opacity=0);
  height: 100%;
  left: 0px;
  opacity: .0;
  position: fixed;
  top: 0px;
  width: 100%;
  z-index: 50;
}

</style>


<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="pull-right" style="height: 70vh;">
        <div class="card-body p-0">
            <div class="row">
    
         
  
                    <div class="card shadow mb-12" style="width:100%">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Member Renewals
                                

                                <a  href="#" id="delete" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm mr-3"  style="float:right; "><i class="fas fa-fw fa-table fa-sm text-white-50"></i> Renew</a>
                            
                            </h6> 

 
                            
    
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-left text-blue-900"><input type="checkbox" id="chk"></th>
                                            <th class="text-left text-blue-900">Miss ID</th>
                                            <th class="text-left text-blue-900">Service ID</th>
                                            <th class="text-left text-blue-900">Expired date</th>
                                            <th class="text-left text-blue-900">Full Name</th>
                                      
                                            <th class="text-left text-blue-900">Phone</th>
                                           
                                            <th class="text-left text-blue-900">Category</th>
                                            <th class="text-left text-blue-900">Status</th>
                                            
                                        
    
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($members as $member)
                                        <tr>
                                            <td> <input type="checkbox" id="del_{{$member->id}}" /></td>
                                            <td>{{$member->memberid}}</td>
                                            <td>{{$member->serviceid}}</td>
                                            <td>{{ Carbon\Carbon::parse($member->renewal_at)->format('d M Y') }}</td>

                                            <td>{{$member->name}}</td>
                                            
                                            <td>{{$member->phone}}</td>
                                         
                                            <td>
                                                @if ($member->category_id != null)
                                                {{$member->category->name}}
                                                @endif
                                            </td>

                                        <td style="padding-bottom: 0"> <p style="font-size: 14px; line-height:12px; margin-bottom:0"> @if ($member->status) <span style="color: green"> Active <br></span> @else Inactive @endif </p>
                                        <br>
                                            {{-- <p style="font-size: 12px">()</p> --}}
                                        </td>

                                         

                                     
                                        @empty
                                            <tr><td>No found</td></tr>
                                        @endforelse
     
                                        
                                     
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
        





            </div>




            </div>
        </div>

    </div>

</div>








<div class="backDrop"></div>

<div class="box scro" style="max-height: 90vh; padding-bottom:0">
        <form action="{{route('member.renew')}}" method="POST">
            @csrf()
            @method('PATCH')
    <p style="font-size: 13px">Payment Type</p>
    <select required="" class="form-control " name="payment_type" id="paymenttype">  
        <option value="1">Cash</option>
        <option value="2">Card</option>
    </select>

    <input type="hidden" name="id[]" id="memid" >


<button type="submit" class="btn1 btn btn-primary" style="margin: 20px 0; width:100%">
    Renew Now
</button>
</form>
</div>




 
    
    @endsection


    @section('script')

    <script type="text/javascript">
        $(document).ready(function(){

$("#chk").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});

$('#delete').click(function(){

  var post_arr = [];

  // Get checked checkboxes
  $('#dataTable input[type=checkbox]').each(function() {
    if (jQuery(this).is(":checked")) {
      var id = this.id;
      var splitid = id.split('_');
      var postid = splitid[1];

      post_arr.push(postid);
      
    }
  });

  console.log(post_arr);

  if(post_arr.length <= 0){

     var isDelete = confirm("Please choose Members");
  }



  if(post_arr.length > 0){

    $(".backDrop").animate({"opacity": ".80"}, 300);
    $(".box").animate({"opacity": "1.0"}, 300);
    $(".backDrop, .box").css("display", "block");

    $('#memid').val(post_arr);

     // var isDelete = confirm("Do you really want to delete records?");
    //   if (isDelete == true) {
    //      // AJAX Request
    //      $.ajax({
    //         url: 'ajaxfile.php',
    //         type: 'POST',
    //         data: { post_id: post_arr},
    //         success: function(response){
    //            $.each(post_arr, function( i,l ){
    //                $("#tr_"+l).remove();
    //            });
    //         }
    //      });
    //   } 
  } 
});






 //lightbox 
 
  $(".close, .backDrop").on("click", function(){
    closeBox();
  });
  function closeBox(){
    $(".backDrop, .box").animate({"opacity": "0"}, 300, function(){
    $(".backDrop, .box").css("display", "none");
    });
  }
 


  //lightbox addon
  const showaddon = (pitem, pid)=>{
    getaddon(pitem);
    getaddonavailable(pid, pitem);

    $(".backDrop").animate({"opacity": ".80"}, 300);
    $(".box2").animate({"opacity": "1.0"}, 300);
    $(".backDrop, .box2").css("display", "block");
  }







});
    </script>


    @endsection
<x-App>

   

    <!--Container-->
    <div class="container w-full mx-auto pt-20">

        <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">

            

           

            <div class="flex flex-row flex-wrap flex-grow mt-2">

                    
                <div class="w-full  md:w-1/2 p-3">
                    <!--Table Card-->
                    <div class="bg-white border rounded shadow">
                        <div class="border-b p-3">
                            <h5 class="font-bold uppercase text-gray-600">Categories</h5>
                        </div>
                        <div class="p-5">
                            <table class="w-full p-5 text-gray-700">
                                <thead>
                                    <tr>
                                        <th class="text-left text-blue-900">Order</th>
                                        <th class="text-left text-blue-900">Name</th>
                                        <th class="text-left text-blue-900">Parant</th>
                                        <th class="text-left text-blue-900">drop</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($categories as $category)
                                    <tr>
                                        <td>{{$category->order}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>
                                            @if ($category->parant()->exists())
                                                {{$category->parant->name}}
                                            @endif
                                            </td>
                                        
                                        <td> <button onclick="document.getElementById({{$category->id}}).submit();">remove</button> 
                                            <form id="{{$category->id}}" method="POST" action="{{ route('category.delete') }}">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{$category->id}}">
                                            </form>
                                        
                                        </td>

                                    </tr>
                                    @empty
                                        <tr><td>No found</td></tr>
                                    @endforelse
 
                                    
                                 
                                </tbody>
                            </table>
 
                        </div>
                    </div>
                    <!--/table Card-->
                </div>




                <!--cat add-->
                <div class="w-full md:w-1/2 p-3">
                    
                    <div class="bg-white border rounded shadow">
                        <div class="border-b p-3">
                            <h5 class="font-bold uppercase text-gray-600">Add</h5>
                        </div>
                        <div class="p-5">
                            <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('category.store') }}">
                                @csrf
            
                                <div class="flex flex-wrap">
                                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                        Name:
                                    </label>
                                    <input id="name" type="name"
                                        class="form-input w-full border-gray-400 @error('name') border-red-500 @enderror" name="name"
                                        value="{{ old('name') }}" required  autofocus>
            
                                        @error('name')
                                        <p class="text-red-500 text-xs italic mt-4">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                </div>

                                <div class="flex flex-wrap">
                                    <label for="parant" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                        Parant:
                                    </label>
                                   
                                        

                                        <select class="form-input w-full border-gray-400" name="parant">
                                            <option value="">Main</option>
                                            @foreach ($categories as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                            
                                        </select>
             
                                </div>


                                <div class="flex flex-wrap">
                                    <label for="order" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                        Order:
                                    </label>
                                    <input id="order" type="number"
                                        class="form-input w-full border-gray-400 @error('name') border-red-500 @enderror" name="order"
                                        value="0" required  autofocus>
             
                                </div>

                                
                                <button type="submit"  
                                class="btn1">
                                    Submit
                                </button>
            
                                
                                
            
                                
                            </form>
                             
                        </div>
                    </div>
                </div>























            </div>

            <!--/ Console Content-->

        </div>


    </div>
    <!--/container-->
    
</x-App>
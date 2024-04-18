<div class="card-body">

   <div class="row">
       <div class="col-md-8">
           <div class="mb-3">
               <label class="form-label">Hostel Name</label>
               <input class="form-control" type="text"
                      name="name"
                      value="{{ $hostel->name ?? '' }}"
                      aria-label=".form-control-sm example">
           </div>

           <div class="">
               <label class="form-label">Hostel Location</label>
               <textarea class="form-control"
                         name="location"
                      aria-label=".form-control-sm example">{{ $hostel->location ?? '' }}</textarea>
           </div>
       </div>
       <div class="col-md-4">
           <div class="mb-3">
               <label class="form-label">Status</label>
               <select class="form-control" name="status">
                   <option value="">Select Status...</option>
                   @foreach(\App\Enums\GeneralStatus::cases() as $status)
                       <option {{ isset($hostel) && $hostel->status === $status->value ? 'selected' : '' }}
                           value="{{ $status->value }}">{{ $status->name }}</option>
                   @endforeach
               </select>
           </div>
       </div>
   </div>

</div>

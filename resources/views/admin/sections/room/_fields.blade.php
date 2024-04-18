<div class="card-body">

   <div class="row">
       <div class="col-md-8">
           <div class="mb-3">
               <label class="form-label">Room Name</label>
               <input class="form-control" type="text"
                      name="name"
                      value="{{ $room->name ?? '' }}"
                      aria-label=".form-control-sm example">
           </div>
       </div>
       <div class="col-md-4">
           <div class="mb-3">
               <label class="form-label">Type</label>
               <select class="form-control" name="type">
                   <option value="">Select Type...</option>
                   @foreach(\App\Enums\RoomType::cases() as $type)
                       <option {{ isset($room) && $room->type === $type->value ? 'selected' : '' }}
                               value="{{ $type->value }}">{{ $type->name }}</option>
                   @endforeach
               </select>
           </div>
           <div class="mb-3">
               <label class="form-label">Status</label>
               <select class="form-control" name="status">
                   <option value="">Select Status...</option>
                   @foreach(\App\Enums\GeneralStatus::cases() as $status)
                       <option {{ isset($room) && $room->status === $status->value ? 'selected' : '' }}
                           value="{{ $status->value }}">{{ $status->name }}</option>
                   @endforeach
               </select>
           </div>
       </div>
   </div>

</div>

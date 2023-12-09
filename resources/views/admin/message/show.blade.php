<x-app-layout>
    <div class="container">
        <h2 class="display-4">
            {{ __('Message').' #'.$message->id }}
        </h2>
        <p class="text-secondary">Created at: {{ $message->created_at }} by <a href="mailto:{{ $message->emai }}?subject=Blooglo - Your Response" class="text-primary text-decoration-none">{{ $message->name }}</a></p>
        <hr>
            <p class="lead">{{ $message->message }}</p>

        <hr>
        <div>
            <b>Actions: </b> 
            <i class="far fa-envelope text-secondary p-2"></i> <a href="mailto:{{ $message->emai }}?subject=Blooglo - Your Response" class="text-primary text-decoration-none">{{ $message->email }}</a>
             | 
             <i class="fas fa-phone-alt text-secondary p-2"></i> <a href="tel:{{ $message->phone }}" class="text-primary text-decoration-none">{{ $message->phone }}</a>
             |
             <form id="deleteMessage{{$message->id}}" action="" method="post" class="form d-inline">
                                        @csrf
                                        @method('delete')
                                        <i class="fas fa-trash-alt p-2 text-danger" onclick="return confirmSubmit({{ $message }});"></i>
                                    </form>
                                    @if($message->status !== 'archive' )
                                    |
                                    <a href="{{ route('message.archive', encrypt($message->id) ) }}"><i class="fas fa-archive text-info p-2"></i></a>
                                    @endif
        </div>

   
       
    </div>
</x-app-layout>

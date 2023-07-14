<x-layout>
    <x-slot name="content">
        <section class="max-w-2xl p-2 mx-auto mt-6">
            <div class="border-2 border-black rounded-md p-6">
                <div class="text-center text-xl">
                    <p class="inline-block">Send message to</p>
                    <p class="inline-block font-bold">" {{request()->username}} "</p>
                </div>
                <form action="{{route('profile.messages.conversation.post.new')}}" method="POST">
                    @csrf
                    <input type="hidden" id="username" name="username" value="{{request()->username}}">
                    <x-form.input name="title"/>
                    <x-form.textarea name="message" label="message"></x-form.textarea>
                    <div class="text-center">
                        <x-form.submitbutton>Send Message</x-form.submitbutton>
                    </div>
                    @error('username')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </form>
            </div>
        </section>
    </x-slot>
</x-layout>

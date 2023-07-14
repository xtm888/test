<x-layout>
    <x-slot name="content">
        <x-adminCP.tabmenu/>
        <div class="max-w-5xl mx-auto p-6 border">
            <h3 class="mb-5 border-b max-w-fit mx-auto">Message to everyone</h3>
            <div class="">
                <form action="{{ route('admin.messages.send') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="mb-2">
                            <label for="title">
                                Title:
                            </label>
                            <textarea name="title" placeholder="Title of the message" id="message"
                                      class="form-control w-full dark:text-black" rows="2"></textarea>
                        </div>
                        <div class=" mb-2">
                            <label for="message">
                                Message:
                            </label>
                            <textarea name="message" placeholder="Paste your message here." id="message"
                                      class="form-control w-full dark:text-black" rows="7"></textarea>
                        </div>

                        <div class="flex gap-3">
                            <label>Groups:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="admins" id="admins"
                                       name="groups[]">
                                <label class="form-check-label" for="admins">
                                    Admins
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="buyers" id="buyers"
                                       name="groups[]">
                                <label class="form-check-label" for="buyers">
                                    Buyers
                                </label>
                            </div>
                        </div>
                        <div class="justify-content-lg-end mt-2">
                            <button type="submit" class="btn btn-outline-primary mt-auto">Send messages</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </x-slot>
</x-layout>

<x-master-layout>
    @livewire('integration', [
        'name'=>$data->name,
        'domain'=>$data->domain,
        'api'=>$data->api,
        'token'=>$data->token,
        'category_id'=>$data->category_id,
    ])

    @push('scripts')
        <script>
            window.addEventListener('show-form', event => {
                $('#form').modal('show');
            })
            window.addEventListener('hide-form', event => {
                $('#form').modal('hide');
            })
            window.addEventListener('show-status', event => {
                $('#status').modal('show');
            })
            window.addEventListener('hide-status', event => {
                $('#status').modal('hide');
            })
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
                Livewire.hook('message.processed', (message, component) => {
                    $(function () {
                        $('[data-toggle="tooltip"]').tooltip()
                    })
                })
            });
        </script>
    @endpush
</x-master-layout>

<div wire:ignore.self class="modal fade" id="mdl_edit" tabindex="-1" role="dialog" aria-labelledby="edit_modal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_modal">{!! $edit_mode ? 'Edit' : 'View' !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="clearAndCloseModal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="update">
                    <div class="form-group">
                        <label for="name">Product Name: {!! $edit_mode ? '<span class="text-danger">*</span>' : '' !!}</label>
                        <input wire:model.defer="product.name" type="text" class="form-control @error('product.name') is-invalid @enderror" {{ $edit_mode ? '' : 'disabled' }}>
                        @include('components.error', ['field' => 'product.name'])
                    </div>
                    @if ($product)
                        <div class="form-group">
                            <label for="name">Existing Photo:</label>
                            <div class="mx-auto border rounded-0 bg-light-gray text-center" style="max-height: 300px">
                                <img src="{{ asset('storage/' . $product->photo) }}" class="img-fluid" style="width: auto; height: 300px;">
                            </div>
                        </div>
                    @endif
                    @if ($edit_mode)
                        <div class="form-group">
                            <label for="photo">Photo:</label>
                            <div class="@error('photo') border border-danger rounded @enderror">
                                <div id="file_upload_edit" class="fileinput fileinput-new input-group mb-0" wire:ignore wire:key="photo" data-provides="fileinput">
                                    <div class="form-control" data-trigger="fileinput">
                                        <span class="fileinput-filename"></span>
                                    </div>
                                    <span class="input-group-append">
                                        <span class="input-group-text fileinput-exists" data-dismiss="fileinput">
                                            Remove
                                        </span>
                                        <span class="input-group-text btn-file">
                                            <span class="fileinput-new">Select file</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" accept="image/*" wire:model.defer="photo">
                                        </span>
                                    </span>
                                </div>
                            </div>
                            @include('components.error', ['field' => 'photo'])
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea wire:model.defer="product.description" class="form-control  @error('product.description') is-invalid @enderror" rows="10" placeholder="Description" {{ $edit_mode ? '' : 'disabled' }}></textarea>
                        @include('components.error', ['field' => 'product.description'])
                    </div>
                    <div class="form-group">
                        <label for="price">Price: {!! $edit_mode ? '<span class="text-danger">*</span>' : '' !!}</label>
                        <input wire:model.defer="product.price" type="number" class="form-control @error('product.price') is-invalid @enderror" min="0" {{ $edit_mode ? '' : 'disabled' }}>
                        @include('components.error', ['field' => 'product.price'])
                    </div>
                    <div class="form-group">
                        <label for="price">Quantity: {!! $edit_mode ? '<span class="text-danger">*</span>' : '' !!}</label>
                        <input wire:model.defer="product.quantity" type="number" class="form-control @error('product.quantity') is-invalid @enderror" min="0" {{ $edit_mode ? '' : 'disabled' }}>
                        @include('components.error', ['field' => 'product.quantity'])
                    </div>
                    @if ($product && !$edit_mode)
                        <small class="d-block">
                            Uploaded By: {{ $product->createdBy->name }} <span class="text-right float-right">{{ $product->created_at->readable() }}</span>
                        </small>
                        @if ($product->created_at != $product->updated_at)
                            <small class="d-block">
                                Last Updated By: {{ $product->updatedBy->name }} <span class="text-right float-right">{{ $product->updated_at->readable() }}</span>
                            </small>
                        @endif
                    @endif
                    @if ($edit_mode)
                        <button class="btn btn-outline-primary" type="submit">Update</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function() {
            $(document).on('clear.bs.fileinput', '#file_upload_edit', function() {
                @this.set('photo', null);
            });

            $(document).on('reset.bs.fileinput', '#file_upload_edit', function() {
                @this.set('photo', null);
            });

            @this.on('clearFileInput', function() {
                $(document).find('#file_upload_edit').fileinput('clear');
            });

            var invalidChars = ['-', 'e', '+', 'E'];

            $('input[type="number"]').on('keydown', function(e) {
                if (invalidChars.includes(e.key)) {
                    e.preventDefault();
                }
            });

            @this.on('closeModal', function() {
                $('#mdl_edit').modal('hide');
            });

            @this.on('openModal', function() {
                $('#mdl_edit').modal('show');
            });

            $(document).on('click', '.btn-delete', function() {
                if (confirm('Are you sure you want to delete this product?')) {
                    @this.call('delete', $(this).val());
                }
            });

            $(document).on('click', '.btn-view', function() {
                @this.call('show', $(this).val());
            });

            $(document).on('click', '.btn-edit', function() {
                @this.call('show', $(this).val(), true);
            });
        });

    </script>
@endpush

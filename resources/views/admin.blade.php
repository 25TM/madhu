{{-- upload csv file --}}

<div class="container-fluid relative animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Upload CSV File</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.upload.csv') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="csv_file">CSV File</label>
                            <input type="file" class="form-control-file" id="csv_file" name="csv_file">
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                    @error('csv_file')
                        <div class="alert alert-danger">{{ $message }}</div>
                        
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>

<div class="input-mail">
    <div class="input-group">
        <textarea type="text" class="form-control" placeholder="Enter email"></textarea>
        <div class="input-group-append">
            <button class="btn btn-primary" type="button">
                <i class="fas fa-search"></i>
                send
            </button>
        </div>
    </div>

</div>
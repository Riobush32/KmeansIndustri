<!doctype html>
<html data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body>
    
</body>
    <div class="card w-[98%] bg-base-100 shadow-xl mx-auto mt-5 border-2">
        <div class="card-body">
            <h2 class="card-title">Data</h2>
            <form action="{{ route('industri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" class="file-input file-input-ghost w-full max-w-xs" name="excel"/>
                <button class="btn btn-outline" type="submit">import</button>
            </form>
            
        </div>
        <div class="card-body">
            <div class="overflow-x-auto">
                <table class="table table-compact w-full">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Kecamatan</th>
                            <th>2011</th>
                            <th>2012</th>
                            <th>2013</th>
                            <th>2014</th>
                            <th>2015</th>
                            <th>2016</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($data))
                            
                        <?php $no = 1; ?>
                        @foreach($data as $item)
                        <tr>
                            <th>{{ $no }}</th>
                            <td>{{ $item->kecamatan }}</td>
                            <td>{{ $item->t2011 }}</td>
                            <td>{{ $item->t2012 }}</td>
                            <td>{{ $item->t2013 }}</td>
                            <td>{{ $item->t2014 }}</td>
                            <td>{{ $item->t2015 }}</td>
                            <td>{{ $item->t2016 }}</td>
                        </tr>
                        <?php $no++; ?>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Kecamatan</th>
                            <th>2011</th>
                            <th>2012</th>
                            <th>2013</th>
                            <th>2014</th>
                            <th>2015</th>
                            <th>2016</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    
        @include('proses')
    @endif
</html>

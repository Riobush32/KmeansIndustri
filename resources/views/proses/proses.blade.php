<div class="card w-[98%] bg-base-100 shadow-xl mx-auto mt-5 border-2 p-5 my-5">
    <form action="" class="form-control">
        <div class="input-group">
            <input type="number" min="1" max="25"placeholder="Masukkan Nilai K..." class="input input-bordered" value="{{ request('kvalue') }}" name="kvalue"/>
            <button class="btn" type="submit">
                Jumlah Kluster
            </button>
        </div>
    </form>
    
</div>

@if ($kvalue != 0)
    
<div class="card w-[98%] bg-base-100 shadow-xl mx-auto mt-5 border-2 p-5 my-5">
    <h1 class="font-bold">Centoroid Awal</h1>
    <div class="overflow-x-auto">
        <table class="table w-full">
            <!-- head -->
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
                <?php 
                    $no = 1; 
                    $kv = $dataKv->take($kvalue);
                ?>
                @foreach($kv as $k)
                <tr>
                    <th>{{ $no }}</th>
                    <th>{{ $k->kecamatan }}</th>
                    <td>{{ $k->t2011 }}</td>
                    <td>{{ $k->t2012 }}</td>
                    <td>{{ $k->t2013 }}</td>
                    <td>{{ $k->t2014 }}</td>
                    <td>{{ $k->t2015 }}</td>
                    <td>{{ $k->t2016 }}</td>
                </tr>
                <?php $no++; ?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card w-[98%] bg-base-100 shadow-xl mx-auto mt-5 border-2 p-5 my-5">
    
    <table class="table w-full">
        <!-- head -->
        <thead>
            <tr>
                <th></th>
                <th>Kecamatan</th>
                <?php $no = 1; ?>
                @while ($no <= $kvalue)
                    <th>C{{ $no }}</th>
                <?php $no++; ?>
                @endwhile
                <th>Jarak Terdekat</th>
                <th>Cluster</th>
                
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1;
                $clusters = $cluster->take($count);
            ?>
        

            @foreach ($clusters as $item)
            <tr>
                <th>{{ $no }}</th>
                <th>{{ $item->data_industri2016s->kecamatan }}</th>
                @for ($i = 1; $i <= $kvalue; $i++)
                    <?php $c = 'c'.$i; ?>
                    <th>{{ $item->$c }}</th>
                @endfor
                <th>{{ $item->cluster }}</th>
                <th>{{ $item->index }}</th>

                <?php $no++; ?>
            </tr>
            @endforeach

            
        </tbody>
    </table>
</div>

<?php 
    $d=1; 
    $count_cluster = count($cluster);
    $while_loop = $count_cluster / $count;
?>
@while ($d < $while_loop)

<div class="card w-[98%] bg-base-100 shadow-xl mx-auto mt-5 border-2 p-5 my-5">
    <?php 
        $no = 1; 
        $kv = $dataKv->skip($kvalue*$d)->take($kvalue);

    ?>
    <h1 class="font-bold">Iterasi {{ $kv[$kvalue*$d]->kecamatan }}</h1>
    <table class="table w-full">
        <thead>
            <tr>
                <th></th>
                <th>2011</th>
                <th>2012</th>
                <th>2013</th>
                <th>2014</th>
                <th>2015</th>
                <th>2016</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($kv as $k)
            <tr>
                <th>{{ $no }}</th>
                <td>{{ $k->t2011 }}</td>
                <td>{{ $k->t2012 }}</td>
                <td>{{ $k->t2013 }}</td>
                <td>{{ $k->t2014 }}</td>
                <td>{{ $k->t2015 }}</td>
                <td>{{ $k->t2016 }}</td>
            </tr>
            <?php $no++; ?>
            @endforeach
            
        </tbody>
    </table>
</div> 

<div class="card w-[98%] bg-base-100 shadow-xl mx-auto mt-5 border-2 p-5 my-5">

    <table class="table w-full">
        <!-- head -->
        <thead>
            <tr>
                <th></th>
                <th>Kecamatan</th>
                <?php $no = 1; ?>
                @while ($no <= $kvalue) <th>C{{ $no }}</th>
                    <?php $no++; ?>
                    @endwhile
                    <th>Jarak Terdekat</th>
                    <th>Cluster</th>

            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1;
                $clusters = $cluster->skip($count*$d)->take($count);
            ?>


            @foreach ($clusters as $item)
            <tr>
                <th>{{ $no }}</th>
                <th>{{ $item->data_industri2016s->kecamatan }}</th>
                @for ($i = 1; $i <= $kvalue; $i++) <?php $c='c' .$i; ?>
                    <th>{{ $item->$c }}</th>
                    @endfor
                    <th>{{ $item->cluster }}</th>
                    <th>{{ $item->index }}</th>

                    <?php $no++; ?>
            </tr>
            @endforeach


        </tbody>
    </table>
</div>
<?php $d++; ?>
@endwhile

<div class="card w-[98%] bg-base-100 shadow-xl mx-auto mt-5 border-2 p-5 my-5">
    <h1 class="font-bold">Hasil Cluster</h1>
    <table class="table w-full">
        <thead>
            <tr>
                <th></th>
                <th>Kecamatan</th>
                <?php $no = 1; ?>
                <th>Cluster</th>
        
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1;
                $clusters = $cluster->skip($count*($while_loop-1))->take($count);
                $p = 0;
            ?>
        
            @while ($p < $kvalue)
                <?php $cl = $clusters->where('index', $p+1) ?>

                @foreach ($cl as $item)
                <tr>
                    <th>{{ $no }}</th>
                    <th>{{ $item->data_industri2016s->kecamatan }}</th>
                    <th>{{ $item->index }}</th>
            
                <?php $no++; ?>
                </tr>
                
                @endforeach
            <?php $p++; ?>
            @endwhile
        
        </tbody>
    </table>
</div>
@endif
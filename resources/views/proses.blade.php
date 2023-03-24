<div class="card w-[98%] bg-base-100 shadow-xl mx-auto mt-5 border-2 p-5 my-5">
    <form action="" class="form-control">
        <div class="input-group">
            <input type="number" placeholder="Masukkan Nilai K..." class="input input-bordered" value="{{ request('kvalue') }}" name="kvalue"/>
            <button class="btn" type="submit">
                Jumlah K
            </button>
        </div>
    </form>
    
</div>

@if ($kvalue != 0)
    


<div class="card w-[98%] bg-base-100 shadow-xl mx-auto mt-5 border-2 p-5 my-5">
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
                <?php $no = 1; ?>
                @foreach($dataKv as $k)
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
                $j = 0; 
                $k_data = array();
            ?>
            @foreach($data as $item)
            <tr>
                    <th>{{ $no }}</th>
                <th>{{ $item->kecamatan }}</th>
                    <?php 
                        $i = 0;
                        $k_nilai = array();
                    ?>

                    @foreach ($dataKv as $item2)
                        <?php 
                            $sum = sqrt(
                                    pow(($item2->t2011)-($item->t2011), 2)+
                                    pow(($item2->t2012)-($item->t2012), 2)+
                                    pow(($item2->t2013)-($item->t2013), 2)+
                                    pow(($item2->t2014)-($item->t2014), 2)+
                                    pow(($item2->t2015)-($item->t2015), 2)+
                                    pow(($item2->t2016)-($item->t2016), 2)
                                );  
                            $k_nilai[] = $sum;
                            $i++;
                        ?>
                        <input type="hidden" name="c{{ $i+1; }}">
                        <th>
                            {{ $sum }}
                        </th>
                    @endforeach
                        
                        <?php
                            $k_data[] = $k_nilai;
                            $k_min = min($k_data[$j]); 
                            $min_index = array_search($k_min, $k_data[$j]);
                            $no++; 
                            $j++;
                        ?>
                        <th>
                            {{ $k_min }}
                        </th>
                        <th>
                            {{ $min_index+1 }}
                        </th>
                        <button type="submit" id="sub" class="hidden"></button>
                        </form>
            </tr>
            

            @endforeach

            <?php 
                $i = 0;
                $k_total = 0;
                $panjang_data = count($k_data);
            ?>

            {{-- @while ($i < 2)
                <?php 
                    $k_total += $k_data[$i][0];
                ?>
            <tr>
                <th>Total : {{ $k_total }}</th>
            </tr>
            @endwhile  --}}
            <tr>
                <th>Rata-Rata</th>
            </tr>
        </tbody>
    </table>
    {{ $k_nilai[0] }}
</div>

<script>
    $(document).ready(function() {
    $('#my-form').on('submit', function(event) {
    event.preventDefault();
    
    var formData = $(this).serialize();
    
    $.ajax({
    url: '{{ route("kmeans.dataCluster") }}',
    method: 'POST',
    data: formData,
    });
    });
    });
</script>
@endif
<select name="" id="">
    for
    @foreach ($datas as $item)
        <option value="">{{ \Carbon\Carbon::parse($item)->format('d/m/Y')}}</option>
    @endforeach
</select>

<ul>
    @foreach ($inscricoes as $item)
        <li>{{ $item->servidor->nome }} - {{ $item->servidor->secretaria->sigla }} - presente? <input type="checkbox"></li>
    @endforeach
</ul>
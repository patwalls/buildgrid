<p>
<strong>{{ $name }}</strong>,
</p>

<p>
A Response for BOM: <strong>{{ $bom_name }}</strong> has been accepted.
</p>


<p>
    You can view it here:  <a href="{{ route('getShowBom', $bom_id)  }}"><strong>View on BuildGrid</strong></a>
</p>

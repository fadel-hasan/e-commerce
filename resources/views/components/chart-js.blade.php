<canvas id="{{ $id }}"></canvas>
<script>
    canvasData.push({
        'id': "{{ $id }}",
        'type': "{{ $type }}",
        'data': '{!! $datasets !!}',
        'title': "{{ $title }}"
    });
</script>

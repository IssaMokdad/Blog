const ajaxRequest = (url, data) => fetch(url, {
    method: 'post',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    body: data
}).then(response => response.json())


$('.addComment').on('submit', function(event) {
    event.preventDefault();
    let id = this.id
    let comment = document.getElementById('addComment' + id + '').value
    let url = '/addcomment'
    let data = JSON.stringify({
        'comment': comment,
        'id': id
    })
    ajaxRequest(url, data).then(data => {
        this.reset()
        if (data.commentTotal === 0) {
            $('#totalComments' + id + '').text('')
            $('#post' + id + '').addClass('d-none')
        } else {
            $('#post' + id + '').removeClass('d-none')
            $('#totalComments' + id + '').text(data.commentTotal + " Comments")
            $('#post' + id + '').append("<div class='mt-2 border rounded border-1 border-dark form-group'><textarea id='" + data.id + "' readonly class='form-control mb-2'>" + data.comment.comment + "</textarea></div>")
        }


    })
})

$('.addLike').on('click', function(event) {
    event.preventDefault();
    let id = $(this).data('id');
    let url = '/addlike'
    let data = JSON.stringify({
        'id': id
    })
    ajaxRequest(url, data).then(data => {
        $('#addLike' + id + '').addClass('d-none')
        $('#removeLike' + id + '').removeClass('d-none')
        let put = document.getElementById('totalLike' + id + '')
        put.innerHTML = data.total
    })
})


$('.removeLike').on('click', function(event) {
    event.preventDefault();
    let id = $(this).data('id');
    let url = '/removelike'
    let data = JSON.stringify({
        'id': id
    })
    ajaxRequest(url, data).then(data => {
        $('#removeLike' + id + '').addClass('d-none')
        $('#addLike' + id + '').removeClass('d-none')
        console.log(data)
        if (data.total !== 0) {
            id = 'totalAfterDislike' + id
            document.getElementById(id).innerHTML = data.total
        }
        if (data.total === 0) {
            // $('#totalAfterDislike'+id+'').val('wwww')
            id = 'totalAfterDislike' + id
            document.getElementById(id).innerHTML = ''
        }
    })
})

$('.deletePost').on('click', function(event) {
    let id = this.id
    event.preventDefault()
    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this post!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                swal("Poof! Your post has been deleted!", {
                    icon: "success",
                });
                $('#deleteForm' + id + '').submit()
            } else {
                swal("Your post is safe!");
            }
        });
})
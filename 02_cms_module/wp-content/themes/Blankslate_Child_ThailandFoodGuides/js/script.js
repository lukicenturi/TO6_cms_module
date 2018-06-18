$(()=>{
    url = $("meta[name='url']").attr('content') + '/wp-json/';
    (function checkLike(){
        if(typeof(localStorage.like) == 'undefined'){
            localStorage.like = JSON.stringify([]);
        }

        like = JSON.parse(localStorage.like);
        like.forEach((id) =>{
            $(`.recipes .wrapper[data-id=${id}]`).find('.like .button').attr('data-like', 1);
        });
    })();

    $(`.recipes .wrapper`).find('.like .button').click((e) => {

        id = e.currentTarget.dataset['id'];
        like = +e.currentTarget.dataset['like'];

        after = like < 0 ? 1 : -1;
        counter = $(`.recipes .wrapper[data-id=${id}]`).find('.like .counter');

        $.get({
            url: `${url}like/${id}/${after}`,
            beforeSend: function(){
                toggleLike(id, after);
                $(`.recipes .wrapper[data-id=${id}]`).find('.like .button').attr('data-like', after);
                counter.html( +counter.html() + after);
            },
            success: function(res){
                counter.html(res);
            }
        });
    });

    function toggleLike(id, after){
        like = JSON.parse(localStorage.like);
        index = like.indexOf(id);


        if(after === -1) like.splice(index);
        else if(index === -1) like.push(id);

        localStorage.like = JSON.stringify(like);
    }

    $("#calculate").click((e)=>{
        e.preventDefault();
        cal = $("#cal").val();
        fat = $("#fat").val();
        car = $("#car").val();

        if(cal == '' || fat == '' || car == ''){
            alert("There are invalid fields");
        }else{
            $.get({
                url: `${url}calculate/${cal}/${fat}/${car}`,
                success: function(res){
                    count = res.length - 1;
                    html = '';
                    for( let i = 0 ; i < count ; i++){
                        html += `
                            <tr>
                                <td>${res[i].name}</td>
                                <td>${res[i].cal}</td>
                                <td>${res[i].fat}</td>
                                <td>${res[i].car}</td>
                                <td>${res[i].qty * 100}</td>
                                <td>${res[i].total_cal}</td>
                                <td>${res[i].total_fat}</td>
                                <td>${res[i].total_car}</td>
                            </tr>
                        `;
                    }

                    html += `
                        <tr>
                            <td colspan="4">Total</td>
                            <td>${res[count].total_qty * 100}</td>
                            <td>${res[count].total_cal}</td>
                            <td>${res[count].total_fat}</td>
                            <td>${res[count].total_car}</td>
                        </tr>
                    `;

                    $(".modal table tbody").html(html);
                    $(".modal").addClass('active');
                }
            })
        }
    })

});
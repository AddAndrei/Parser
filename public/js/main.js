function Ajax(url,data,callback)
{
    $.ajax({
        url:url,
        type:'POST',
        data:({parser:data}),
        success:res=>{
            callback(res);
        }
    })
}



function getCourse()
{
    Ajax('/getcourse','',(res)=>{
        let arr = [];
        for (let i in res){
            let rate = (res[i].rate == undefined) ? `` : `${res[i].rate}`;
            arr.push(`<tr><td><b>${res[i].CharCode}:</b></td>
                <td>${res[i].Nominal}</td>
                <td>${res[i].Value}</td>
                <td>${rate}</td>
                </tr>`);
            $('#parser').html(arr.join());
        }
    });
}

$(document).ready(function () {
    $.ajaxSetup({
       headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
    });
    getCourse();
    let parser = setInterval(getCourse,10000);
});

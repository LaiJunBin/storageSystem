

<input type="hidden" id="class_data" value="{{$classStock}}">
<input type="hidden" id="material_data" value="{{$material}}">
<input type="checkbox" class="searchCheckbox" value="依照月份查詢" checked>依照月份查詢
<input type="checkbox" class="searchCheckbox" value="自訂區間查詢" >自訂區間查詢
<div id="searchPatternDiv">
    <form action="#" method="post" id="searchForm">
        <div class="inputDiv">
            <input name="date" type="month" required class="form-control">
        </div>
        <div class="inputDiv" style="display:none;">
            日期A：<input name="date" disabled required type="date" class="form-control">
            日期B：<input name="date" disabled required type="date" class="form-control">
        </div>
        <button type="submit" id="searchBtn" class="btn btn-success" style="width:100%;margin:10px 0;">查詢</button>
    </form>
</div>
<div class="row">
    <div class="col-4">
        <div class="list-group" id="list-tab" role="tablist">
            @forelse ($classNames as $className)
                <a class="list-group-item list-group-item-action @if ($loop->first)
                    active
                @endif">{{$className}}</a>
            @empty
                <div class="list-group-item list-group-item-action">沒有教室</div>
            @endforelse
        </div>
    </div>
    <div class="col-8">
        <div class="tab-content" id="nav-tabContent">            
            <div class="tab-pane show active" role="tabpanel" aria-labelledby="list-home-list">
                
            </div>
        </div>
    </div>
</div>

<script>

    $(function(){
        
        var classData = JSON.parse($("#class_data").val());
        var materialData = JSON.parse($("#material_data").val());
        var date = null;
        $("#class_data,#material_data").remove();
        $("a.list-group-item").click(function(){
            var currentClass = $(this).text();
            if($("a.list-group-item.active").text() != currentClass){
                $("a.list-group-item").removeClass('active');
                $(this).addClass('active');
                $("#nav-tabContent>div").hide();
                render_data(currentClass);
                setTimeout(function(){
                    $("#nav-tabContent>div").fadeIn();
                },100);
            }
        });
        function isEmptyObject(obj){
            var isEmpty = true;
            Object.keys(obj).forEach(function(key){
                if(Object.keys(obj[key]).length !=0)
                    isEmpty = false;
            });
            return isEmpty;
        }
        function render_data(currentClass){
            var data = {};
            $.each(classData[currentClass],function(class_index,currentClassData){
                if (data[currentClassData.category] == undefined)
                    data[currentClassData.category] = {}
                var reg = null;
                if(date != null && !(date instanceof Array)){
                    reg = new RegExp('^'+date);
                    if(reg.exec(currentClassData.date)){
                        $.each(currentClassData.item.unit,function(unit_index,currentUnit){
                            if(data[currentClassData.category][materialData[unit_index]] == undefined)
                                data[currentClassData.category][materialData[unit_index]] = {}
                            if(data[currentClassData.category][materialData[unit_index]][currentUnit] == undefined)
                                data[currentClassData.category][materialData[unit_index]][currentUnit] = 0
                            data[currentClassData.category][materialData[unit_index]][currentUnit] +=
                                parseInt(currentClassData.item.amount[unit_index]);
                        });
                    }
                }else if(date != null && date.length ==2){
                    var minDate = Math.min(Date.parse(date[0]),Date.parse(date[1]));
                    var maxDate = Math.max(Date.parse(date[0]),Date.parse(date[1]));
                    var currentDate = Date.parse(currentClassData.date);
                    if(currentDate>=minDate && currentDate<=maxDate){
                        $.each(currentClassData.item.unit,function(unit_index,currentUnit){
                            if(data[currentClassData.category][materialData[unit_index]] == undefined)
                                data[currentClassData.category][materialData[unit_index]] = {}
                            if(data[currentClassData.category][materialData[unit_index]][currentUnit] == undefined)
                                data[currentClassData.category][materialData[unit_index]][currentUnit] = 0
                            data[currentClassData.category][materialData[unit_index]][currentUnit] +=
                                parseInt(currentClassData.item.amount[unit_index]);
                        });
                    }
                }else{
                    $.each(currentClassData.item.unit,function(unit_index,currentUnit){
                        if(data[currentClassData.category][materialData[unit_index]] == undefined)
                            data[currentClassData.category][materialData[unit_index]] = {}
                        if(data[currentClassData.category][materialData[unit_index]][currentUnit] == undefined)
                            data[currentClassData.category][materialData[unit_index]][currentUnit] = 0
                        data[currentClassData.category][materialData[unit_index]][currentUnit] +=
                            parseInt(currentClassData.item.amount[unit_index]);
                    });
                }
                
            });
            if(!isEmptyObject(data)){
                $("#nav-tabContent>div").html('');
                Object.keys(data).forEach(function(category){
                    if(Object.keys(data[category]).length != 0){
                        $("#nav-tabContent>div").append('<button class="list-group-item list-group-item-action">'+category+'</button>');
                        $("#nav-tabContent>div").append('<div class="classMoreDiv" style="display:none;"></div>');
                        $("#nav-tabContent>div .classMoreDiv").last().html(
                            '<table class="rwd-table">'+
                                '<tr>'+
                                    '<th>材料</th>'+
                                    '<th>數量</th>'+
                                    '<th>單位</th>'+
                                '</tr>'+
                            '</table>'
                        )
                        Object.keys(data[category]).forEach(function(item){
                            Object.keys(data[category][item]).forEach(function(unit){
                                if(data[category][item][unit]!=0){
                                    $("#nav-tabContent>div .classMoreDiv").last().find('.rwd-table').append(
                                        '<tr>'+
                                            '<td data-th="材料">'+((item=='undefined')?'<span style="color:red">這個材料已經被刪除</span>':item)+'</td>'+
                                            '<td data-th="數量">'+data[category][item][unit]+'</td>'+
                                            '<td data-th="單位">'+unit+'</td>'+
                                        '</tr>'
                                    );
                                }
                                //console.log(category,item,unit,data[category][item][unit]);
                            });
                        });
                    }
                });
                $('button.list-group-item-action').click(function(){
                    if($('button.list-group-item-action:not(.active)').index(this)!=-1){
                        var index = $('button.list-group-item-action').index(this);
                        $('.classMoreDiv').hide();
                        $('button.list-group-item-action').removeClass('active');
                        $(this).addClass('active');
                        $('.classMoreDiv').eq(index).slideDown();
                    }
                });
            }else
                $("#nav-tabContent>div").html('沒有紀錄'); 
            console.log(data);
        }
        $(".searchCheckbox").click(function(){
            $('.searchCheckbox').prop('checked',false);
            $(this).prop('checked',true);
            var index = $('.searchCheckbox').index(this);
            $('#searchPatternDiv .inputDiv').hide();
            $('#searchPatternDiv .inputDiv input').prop('disabled',true);
            $('#searchPatternDiv .inputDiv').eq(index).fadeIn();
            $('#searchPatternDiv .inputDiv').eq(index).find('input').prop('disabled',false);
        });

        $("#searchForm").on('submit',function(){
            var index = $('.searchCheckbox').index($('.searchCheckbox:checked'));
            switch(index){
                case 0:
                    date = $("#searchPatternDiv .inputDiv").eq(index).find('input').val();
                    break;
                case 1:
                    date = [
                        date = $("#searchPatternDiv .inputDiv").eq(index).find('input').eq(0).val(),
                        date = $("#searchPatternDiv .inputDiv").eq(index).find('input').eq(1).val()
                    ]
                    break;
            }
            render_data($("a.list-group-item.active").text());
            if($('#searchForm').find($("#removeSearchBtn")).length==0){
                $(this).append('<button id="removeSearchBtn" class="btn btn-danger" style="margin:10px 0;">取消查詢</button>');
                $("#removeSearchBtn").click(function(){
                    date = null;
                    $(this).remove();
                    render_data($("a.list-group-item.active").text());
                });
            }
            return false;
        });
        render_data($("a.list-group-item.active").text());
        console.log(classData);
    });
</script>
<style>
    .list-group-item{
        cursor:pointer;
    }
</style>
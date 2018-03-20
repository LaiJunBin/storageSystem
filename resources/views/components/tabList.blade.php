

<input type="hidden" id="class_data" value="{{$classStock}}">
<input type="hidden" id="material_data" value="{{$material}}">
<div class="row">
    <div class="col-4">
        <div class="list-group" id="list-tab" role="tablist">
            @foreach ($classNames as $className)
                <a class="list-group-item list-group-item-action @if ($loop->first)
                    active
                @endif">{{$className}}</a>
            @endforeach
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
        $("#class_data,#material_data").remove();
        $("a.list-group-item").click(function(){
            $("a.list-group-item").removeClass('active');
            $(this).addClass('active');
            $("#nav-tabContent>div").hide();
            var currentClass = $(this).text();
            render_data(currentClass);
            setTimeout(function(){
                $("#nav-tabContent>div").fadeIn();
            },100)
        });
        function render_data(currentClass){
            var data = {};
            $.each(classData[currentClass],function(class_index,currentClassData){
                if (data[currentClassData.category] == undefined)
                    data[currentClassData.category] = {}
                $.each(currentClassData.item.unit,function(unit_index,currentUnit){
                    if(data[currentClassData.category][materialData[unit_index]] == undefined)
                        data[currentClassData.category][materialData[unit_index]] = {}
                    if(data[currentClassData.category][materialData[unit_index]][currentUnit] == undefined)
                        data[currentClassData.category][materialData[unit_index]][currentUnit] = 0
                    data[currentClassData.category][materialData[unit_index]][currentUnit] +=
                        parseInt(currentClassData.item.amount[unit_index]);
                });
            });
            if(Object.keys(data).length != 0){
                $("#nav-tabContent>div").html('');
                Object.keys(data).forEach(function(category){
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
                            $("#nav-tabContent>div .classMoreDiv").last().find('.rwd-table').append(
                                '<tr>'+
                                    '<td data-th="材料">'+item+'</td>'+
                                    '<td data-th="數量">'+data[category][item][unit]+'</td>'+
                                    '<td data-th="單位">'+unit+'</td>'+
                                '</tr>'
                            );
                            //console.log(category,item,unit,data[category][item][unit]);
                        });
                    });
                    
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
        render_data($("a.list-group-item.active").text());
    });
</script>
<style>
    .list-group-item{
        cursor:pointer;
    }
</style>
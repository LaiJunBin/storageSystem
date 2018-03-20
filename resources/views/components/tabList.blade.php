

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
                123
            </div>
        </div>
    </div>
</div>

<script>

    $(function(){
        var classData = JSON.parse($("#class_data").val());
        var materialData = JSON.parse($("#material_data").val());
        $(".list-group-item").click(function(){
            $(".list-group-item").removeClass('active');
            $(this).addClass('active');
            $("#nav-tabContent>div").hide();
            setTimeout(function(){
                $("#nav-tabContent>div").fadeIn();
            },100)
            var currentClass = $(this).text();
            var data = {};
            $.each(classData[currentClass],function(class_index,currentClassData){
                if (data[currentClassData.category] == undefined)
                    data[currentClassData.category] = {}
                $.each(currentClassData.item.unit,function(unit_index,currentUnit){
                    if(data[currentClassData.category][currentUnit] == undefined)
                        data[currentClassData.category][currentUnit] = 0;
                    data[currentClassData.category][currentUnit] +=
                        parseInt(currentClassData.item.amount[unit_index]);
                });
            });
            console.log(data);

        });
        console.log(classData,materialData);
    });
    
</script>
<style>
    .list-group-item{
        cursor:pointer;
    }
</style>
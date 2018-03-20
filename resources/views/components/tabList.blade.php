

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
        $("#class_data,#material_data").remove();
        $("a.list-group-item").click(function(){
            $("a.list-group-item").removeClass('active');
            $(this).addClass('active');
            $("#nav-tabContent>div").hide();
            var currentClass = $(this).text();
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
            $("#nav-tabContent>div").html('');
            Object.keys(data).forEach(function(category){
                $("#nav-tabContent>div").append('<button class="list-group-item list-group-item-action">'+category+'</button>');
                
            });
            console.log(data);

            setTimeout(function(){
                $("#nav-tabContent>div").fadeIn();
            },100)
        });
        console.log(classData,materialData);
    });
    
</script>
<style>
    .list-group-item{
        cursor:pointer;
    }
</style>
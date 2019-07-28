(function(tiny){
    tiny.PluginManager.add('chemEditor', function(editor,url){
        var icon = url+'/images/molecule.png'
        editor.addButton('chemEditor',{
            title : 'Chemistry Editor',
            image: icon,
            onClick(){
                editor.windowManager.open({
                    url: url + '/editor.html',
                    title: 'Chemistry Editor',
                    width: 640,
                    height: 420
                });           
            } 
        });
    });        
}(tinymce));

 

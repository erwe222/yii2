<a onclick="test()">点击</a>


<script>
    function test(){
        layer.open({
              title:'asdf',
              type: 2,
              area: ['500px', '400px'],
              fixed: true, //不固定
              resize:false,
              maxmin: true,
              content: '/auth/get-routes-box'
        });
    }
</script>
<frameset rows="100,*"  frameborder="no" border="0" framespacing="0" >
  <frame src="{{ url('/user/top') }}" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" style="background-color: #F0F0F0" />
  <frameset cols="200,*" frameborder="no" border="0" framespacing="0">
    <frame src="{{ url('/user/left') }}"  name="leftFrame" scrolling="No" noresize="noresize" id="leftFrame" style="background-color: #FCFCFC" />
    <frame src="{{ url('/user/right') }}"  name="mainFrame" id="mainFrame" />
  </frameset>
</frameset>
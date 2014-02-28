<script src="http://www.youtube.com/iframe_api"></script>
<script src="http://sharpframe.co.uk:9898/socket.io/socket.io.js"></script>
<script src="/js/VideoController.js"></script>
<div id="roomwrapper">
    <h1>{{room.title}}</h1>
    <h2>{{room.discription}}</h2>
    <div id="playerwrapper">
        <div id="player" style="pointer-events: none"></div>
    </div>
    <div id="chatwrapper" class="gradient-top">
        Test
    </div>
    <div class="clrfloats"></div>
    <div id="roominfo" class="gradient-top">
        <table>
            <tr>
                <td>
                    Views:
                </td>
                <td>
                    
                </td>
                <td>
                    Connected Users:
                </td>
                <td>
                    
                </td>
            </tr>
        </table>
    </div>
</div>
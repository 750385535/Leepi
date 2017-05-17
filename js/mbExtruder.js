/**
 * Created by Tovin on 11/23/16.
 */
$(function () {
    $("#extruderTop").buildMbExtruder({
        width: 400,
        extruderOpacity: 1,
        onExtOpen: function () {
            $("#bottomMenu-screen").css("display", "block");
            $("#bottomMenu").addClass("kai");
        },
        onExtContentLoad: function () {
        },
        onExtClose: function () {
            $("#bottomMenu-screen").css("display", "none");
            $("#bottomMenu").removeClass("kai");
        },
        positionFixed: true,
        sensibility: 800,
        position: "top", // left, right, bottom
        flapDim: 100,
        textOrientation: "bt", // or "tb" (top-bottom or bottom-top)
        hidePanelsOnClose: true,
        autoCloseTime: 0, // 0=never
        slideTimer: 300
    });

    
    $("#bottomMenu-screen").css("display", "none");
    
    $("#bottomMenu").click(function () {
        if ($(".extruder-content").css("display") == "block") {
            setTimeout(function () {
                $('#top2').enableExtruderVoice();
            }, 400);
        }
        else if ($(".extruder-content").css("display") == "none") {
            $('#extruderTop').openMbExtruder(true);
            setTimeout(function () {
                $('#top2').disableExtruderVoice();
            }, 400);
        }
    });

    // $("#bottomMenu-screen").click(function () {
    //     setTimeout(function () {
    //         $('#top2').enableExtruderVoice();
    //     }, 400);
    //     $("#bottomMenu-screen").css("display", "none");
    //     $("#bottomMenu").removeClass("kai");
    // });

    // $('#bottomMenu-screen').trigger("click");//自动执行click事件
});
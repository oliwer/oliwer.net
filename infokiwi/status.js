// ******** Status Bar Javascript Magic by Likno 1.0 **********
function status_start() {clearInterval(status.sttm);status_init();if (arguments.length>0) status_init2(arguments[0]);status.sttm=setInterval ("doEffect('status')",10);}
function status_stop() {clearInterval(status.sttm);window.status="";}

status_init();
function status_init() {status={stel:0,stft:"",stec:1,stcel:1,stce:-1,stcl:-1,stls:-1,stcs:0,sttg:0,stea:["Info Kiwi",11,10,1]};}
function status_init2 (en) {status.stea=[status.stea[(en-1)*4],status.stea[(en-1)*4+1],status.stea[(en-1)*4+2],status.stea[(en-1)*4+3]];status.stec=1;status.stel=0;}
function doEffect(es) {var s=eval(es);if (s.stce==s.stec) {if (s.stcel==s.stel) {clearInterval(s.sttm);window.status=s.stft;return;} else {if (s.stel>0) s.stcel++;s.stce=-1;s.stcl=s.stls;}}if (s.stcl==s.stls) {s.stce++;s.sttx=s.stea[s.stce*4];s.sttp=s.stea[s.stce*4+1];s.stsd=s.stea[s.stce*4+2];s.stls=s.stea[s.stce*4+3];s.stcl=0;s.stsp=1;s.sttg=0;}if (21-s.stsd-s.sttg==0) {var stres=eval("stEffect"+s.sttp+"(s.sttx,s.stsp++,es);");s.sttg=0;if (stres!="") window.status=stres;else {s.stcl++;s.stsp=1;}}s.sttg++;}
function stEffect11(text,step){if (step>3) return ""; else return text;}
status_start();
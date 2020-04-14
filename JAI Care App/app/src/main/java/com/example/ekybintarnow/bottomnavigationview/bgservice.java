package com.example.ekybintarnow.bottomnavigationview;

import android.annotation.SuppressLint;
import android.app.Service;
import android.content.Intent;
import android.os.Handler;
import android.os.IBinder;
import android.os.Message;
import android.widget.Toast;

import java.util.Timer;
import java.util.TimerTask;

public class bgservice extends Service
{
    private static Timer timer = new Timer();

    public IBinder onBind (Intent arg0)
    {
        return null;
    }

    public void onCreate ()
    {
        super.onCreate();
        startService();
    }


    private void startService ()
    {
        timer.scheduleAtFixedRate(new mainTask(), 0, 5000);
    }


    private class mainTask extends TimerTask {
        public void run() {
            //toastHandler.sendEmptyMessage(0);
        }
    }
    public void onDestroy ()
    {
        super.onDestroy();
        Toast.makeText(this, "Service Stopped ...", Toast.LENGTH_SHORT).show();
    }
    @SuppressLint("HandlerLeak")
    private final Handler toastHandler = new Handler() {
        @Override
        public void handleMessage(Message msg) {
            Toast.makeText(getApplicationContext(), "Service Started ...", Toast.LENGTH_SHORT).show();
        }
    };
}

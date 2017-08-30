package notifications.android.notifyme;

import android.app.Activity;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.Bundle;
import android.support.v4.content.LocalBroadcastManager;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.ListView;
import android.os.AsyncTask;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;

import java.util.ArrayList;
import java.util.List;

public class MainActivity extends Activity {

    ListView list;
    CustomListAdapter adapter;
    ArrayList<Model> modelList;
    String title, text;
    private String URL_NEW_POST = "http://192.168.1.104/db_notifyme/db_create.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        modelList = new ArrayList<>();
        adapter = new CustomListAdapter(getApplicationContext(), modelList);
        list=(ListView)findViewById(R.id.list);
        list.setAdapter(adapter);
        LocalBroadcastManager.getInstance(this).registerReceiver(onNotice, new IntentFilter("Msg"));
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_main, menu);//Menu Resource, Menu
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.action_settings:
                Intent intent = new Intent(
                        "android.settings.ACTION_NOTIFICATION_LISTENER_SETTINGS");
                startActivity(intent);
                return true;
            default:
                return super.onOptionsItemSelected(item);
        }
    }
    private BroadcastReceiver onNotice= new BroadcastReceiver() {

        @Override
        public void onReceive(Context context, Intent intent) {
            //String pack = intent.getStringExtra("package");
            title = intent.getStringExtra("title");
            text = intent.getStringExtra("text");
            new Create_Part().execute();
            //int id = intent.getIntExtra("icon",0);
            Context remotePackageContext = null;
            try {
//                remotePackageContext = getApplicationContext().createPackageContext(pack, 0);
//                Drawable icon = remotePackageContext.getResources().getDrawable(id);
//                if(icon !=null) {
//                    ((ImageView) findViewById(R.id.imageView)).setBackground(icon);
//                }
                byte[] byteArray =intent.getByteArrayExtra("icon");
                Bitmap bmp = null;
                if(byteArray !=null) {
                    bmp = BitmapFactory.decodeByteArray(byteArray, 0, byteArray.length);
                }
                Model model = new Model();
                model.setName(title +" " +text);
                model.setImage(bmp);

                if(modelList !=null) {
                    modelList.add(model);
                    adapter.notifyDataSetChanged();
                }else {
                    modelList = new ArrayList<>();
                    modelList.add(model);
                    adapter = new CustomListAdapter(getApplicationContext(), modelList);
                    list=(ListView)findViewById(R.id.list);
                    list.setAdapter(adapter);
                }
            }
            catch (Exception e) {
                e.printStackTrace();
            }
        }
    };

    private class Create_Part extends AsyncTask<String, Void, Void> {

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
        }

        @Override
        protected Void doInBackground(String... arg) {
            List<NameValuePair> params = new ArrayList<>();
            params.add(new BasicNameValuePair("title", title));
            params.add(new BasicNameValuePair("text", text));
            ServiceHandler serviceClient = new ServiceHandler();

            serviceClient.makeServiceCall(URL_NEW_POST, ServiceHandler.POST, params);
            Log.i("Msg", String.valueOf(params));
            Log.i("Msg","Notification Posted to server");

            /*if (json != null) {
            try {
                JSONObject jsonObj = new JSONObject(json);
                Log.i("Msg","Notification Posted");
                boolean error = jsonObj.getBoolean("error");
                if (!error) {
                    // new category created successfully
                    Log.i("Msg","Notification added successfully");
                } else {
                    Log.i("Msg","Add Notification Error");
                }
            }
            catch (JSONException e) {
                e.printStackTrace();
            }

            }*/
            return null;
        }

        @Override
        protected void onPostExecute(Void result) {
            super.onPostExecute(result);
        }
    }
}


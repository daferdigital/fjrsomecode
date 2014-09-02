package com.fjr.maternidadlafloresta;

import org.json.JSONArray;

import android.os.Bundle;
import android.app.Activity;
import android.view.Menu;

/**
 * Clase principal donde se refresca cada N segundos.
 * 
 * @author FJR
 *
 */
public class MainActivity extends Activity {
	private static final long AUTO_REFRESH_VALUE = 60000;
	private JSONArray user = null;
	
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.activity_main, menu);
        return true;
    }
}

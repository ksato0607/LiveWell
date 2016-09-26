﻿using Android.App;
using Android.Widget;
using Android.OS;

namespace EmployeeTest
{
	[Activity(Label = "EmployeeTest", MainLauncher = true, Icon = "@mipmap/icon")]
	public class MainActivity : Activity
	{
		protected override void OnCreate(Bundle savedInstanceState)
		{
			base.OnCreate(savedInstanceState);

			// Set our view from the "main" layout resource
			SetContentView(Resource.Layout.Main);

			Button createButton = FindViewById<Button>(Resource.Id.Create);
			createButton.Click += delegate
			{
				SetContentView(Resource.Layout.CreateAccount);
			};
		}

	}
}


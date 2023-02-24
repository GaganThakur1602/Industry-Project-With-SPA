</body>
</html>
<html>
    <head>
        <title>Welcome</title>
        <style>
            b{
                color: black;
            }
            Body {
                Background: #1488EA;
            }
            #Card {
                Position: Relative;
                Top: 110px;
                Width: 320px;
                Display: Block;
                Margin: Auto;
                Text-Align: Center;
                Font-Family: "Source Sans Pro", Sans-Serif;
            }
            #Upper-Side {
                Padding: 2em;
                Background-Color: #8BC34A;
                Display: Block;
                Color: #Fff;
                Border-Top-Right-Radius: 8px;
                Border-Top-Left-Radius: 8px;
            }
            #Checkmark {
                Font-Weight: Lighter;
                Fill: #Fff;
                Margin: -3.5em Auto Auto 20px;
            }
            #Status {
                Font-Weight: Lighter;
                Text-Transform: Uppercase;
                Letter-Spacing: 2px;
                Font-Size: 1em;
                Margin-Top: -0.2em;
                Margin-Bottom: 0;
            }
            #Lower-Side {
                Padding: 2em 2em 5em 2em;
                Background: #Fff;
                Display: Block;
                Border-Bottom-Right-Radius: 8px;
                Border-Bottom-Left-Radius: 8px;
            }
            #Message {
                Margin-Top: -0.5em;
                Color: #757575;
                Letter-Spacing: 1px;
            }
            #ContBtn {
                Position: Relative;
                Top: 1.5em;
                Text-Decoration: None;
                Background: #8bc34a;
                Color: #Fff;
                Margin: Auto;
                Padding: 0.8em 3em;
                -Webkit-Box-Shadow: 0px 15px 30px Rgba(50, 50, 50, 0.21);
                -Moz-Box-Shadow: 0px 15px 30px Rgba(50, 50, 50, 0.21);
                Box-Shadow: 0px 15px 30px Rgba(50, 50, 50, 0.21);
                Border-Radius: 25px;
                -Webkit-Transition: All 0.4s Ease;
                -Moz-Transition: All 0.4s Ease;
                -O-Transition: All 0.4s Ease;
                Transition: All 0.4s Ease;
            }
            #ContBtn:hover {
                -Webkit-Box-Shadow: 0px 15px 30px Rgba(60, 60, 60, 0.4);
                -Moz-Box-Shadow: 0px 15px 30px Rgba(60, 60, 60, 0.4);
                Box-Shadow: 0px 15px 30px Rgba(60, 60, 60, 0.4);
                -Webkit-Transition: All 0.4s Ease;
                -Moz-Transition: All 0.4s Ease;
                -O-Transition: All 0.4s Ease;
                Transition: All 0.4s Ease;
            }
        </style>
    </head>
    <body>
        <Div Id="Card" Class="Animated FadeIn">
        <Div Id="Upper-Side">
            <!-- Generator: Adobe Illustrator 17.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0) -->
            <?echo 'Xml Version="1.0" Encoding="Utf-8"'?>
            <!DOCTYPE Svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "Http://Www.W3.Org/Graphics/SVG/1.1/DTD/Svg11.Dtd">
            <Svg
                Version="1.1"
                Id="Checkmark"
                Xmlns="Http://Www.W3.Org/2000/Svg"
                Xmlns:xlink="Http://Www.W3.Org/1999/Xlink"
                X="0px"
                Y="0px"
                Xml:space="Preserve"
            >
                <Path
                    D="M131.583,92.152l-0.026-0.041c-0.713-1.118-2.197-1.447-3.316-0.734l-31.782,20.257l-4.74-12.65 C-0.483-1.29-1.882-1.958-3.124-1.493l-0.045,0.017c-1.242,0.465-1.857,1.888-1.374,3.178l5.763,15.382 C0.131,0.351,0.334,0.65,0.579,0.898c0.028,0.029,0.06,0.052,0.089,0.08c0.08,0.073,0.159,0.147,0.246,0.209 C0.071,0.051,0.147,0.091,0.222,0.133c0.058,0.033,0.115,0.069,0.175,0.097c0.081,0.037,0.165,0.063,0.249,0.091 C0.065,0.022,0.128,0.047,0.195,0.063c0.079,0.019,0.159,0.026,0.239,0.037c0.074,0.01,0.147,0.024,0.221,0.027 C0.097,0.004,0.194-0.006,0.292-0.014c0.055-0.005,0.109-0.003,0.163-0.012c0.323-0.048,0.641-0.16,0.933-0.346l34.305-21.865 C131.967,94.755,132.296,93.271,131.583,92.152z"
                />
                <Circle
                    Fill="None"
                    Stroke="#Ffffff"
                    Stroke-Width="5"
                    Stroke-Miterlimit="10"
                    Cx="109.486"
                    Cy="104.353"
                    R="32.53"
                />
            </Svg>
            <H3 Id="Status">Success</H3>
        </Div>
        <Div Id="Lower-Side">
            <P Id="Message">
                Congratulations, Your Account Has Been Successfully Created.
                <br><b>Login To Continue Submitting Your Ticket</b>
            </P>
            <A ui-sref="home" Id="ContBtn">Continue</A>
        </Div>
    </Div>
    </body>
</html>
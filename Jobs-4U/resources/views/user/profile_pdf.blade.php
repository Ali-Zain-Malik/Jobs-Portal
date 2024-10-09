<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile - {{ $user->name }}</title>
</head>
<style>
    *
    {
        font-family: "calibri";
    }
    .main-container
    {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }
    .name-div
    {
        display: flex;
        align-items: center;
        justify-content: space-around;
        padding-left: 30px;
        gap: 20px;
    }
    .description
    {
        width: 100%;
        display: flex;
        justify-content: center;
        flex-direction: column;
        padding-left: 30px;
    }
    .skills-div
    {
        width: 100%;
        padding-left: 30px;
    }
    .experience-div, .education-div
    {
        width: 100%;
        padding-left: 30px;
    }
    .experience, .education
    {
        width: 100%;
        display: flex;
        flex-direction: column;
    }
    .exp-details, .edu-details
    {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-top: 15px;
        margin-bottom: 5px;
        
    }
</style>

<body>
    <!-- Main container containing everthing -->
    <div class="main-container">

        <!-- Name section -->
        <div class="name-div">
            <h3>Name:</h3><p style="font-size: 18px;">{{$user->name}}</p>
        </div>
        <!-- Name section ends here -->

        <hr style="width: 100%;">

        <!-- Description Section starts here -->
        <div class="description">
            <h3 style="margin: 0;">Description</h3> 
            <p style="font-size: 16px;">
                {{$user->description}}
            </p>
        </div>
        <!-- Description section ends here -->


        <hr style="width: 100%;">


        <!-- Skills section starts here -->
        <div class="skills-div">
            <h3 style="margin: 0;">Skills</h3>
            <ul>
                @foreach($user_skills as $skill)
                    <li>{{ $skill->skill_name }}</li>
                @endforeach
            </ul>
        </div>
        <!-- Skills section ends here -->


        <hr style="width: 100%;">


        <!-- Experience heading and plus icon -->
        <div class="experience-div">
            <h3 style="margin: 0; text-align:center;">Experience</h3>
            <div class="experience">
                @foreach($user_experience as $experience)
                    <div class="exp-details">
                        <h4>{{ $experience->company }}</h4>
                        ({{ $experience->designation }})
                    </div>
                @endforeach
            </div>  
        </div>
        <!-- Experience heading ends -->

       

        <hr style="width: 100%;">

        <!-- Education heading starts here and plus icon -->
        <div class="education-div">
            <h3 style="margin: 0; text-align:center;">Education</h3>
            <div class="education">
                @foreach($user_education as $education)
                    <div class="edu-details">
                        <h4>{{ $education->program }}</h4>
                        ({{ $education->institute }})
                    </div>
                @endforeach
            </div>  
        </div>
        <!-- Education heading ends here -->

    </div>
    <!-- Main container ends here -->

</body>
</html>
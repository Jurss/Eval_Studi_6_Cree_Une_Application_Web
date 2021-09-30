<?php
include "../inc/function.php";
logged_only();
?>

<div class="jumbotron container1">
    <div id="createMission" class="box">
        <h2>Create New Mission</h2>
        <form action="createMission/createMission.php">
            <button type="submit" class="restyle-btn btn btn-info">Create</button>
        </form>
    </div>
</div>

<main class="jumbotron container2">
        <div class="box box-1">
            <h2>See the data from: </h2>
            <form action="listingData.php" method="post" class="form-horizontal">
                <fieldset>
                    <select class="form-control" name="table" id="table">
                        <option>Admin</option>
                        <option>Speciality</option>
                        <option>Agent</option>
                        <option>Target</option>
                        <option>Contact</option>
                        <option>Safe_house</option>
                        <option>Mission</option>
                    </select>
                    <button type="submit" class="restyle-btn btn btn-info">See</button>
                </fieldset>
            </form>
        </div>
        <div class="box box-2">
            <h2>Insert data to:</h2>
            <form action="insertData.php" method="post" class="form-horizontal">
                <fieldset>
                    <select class="form-control" name="table" id="table">
                        <option>Admin</option>
                        <option>Speciality</option>
                        <option>Agent</option>
                        <option>Target</option>
                        <option>Contact</option>
                        <option>SafeHouse</option>
                        <option>Mission</option>
                    </select>
                    <button type="submit" class="restyle-btn btn btn-info">See</button>
                </fieldset>
            </form>
        </div>
        <div class="box box-3">
            <h2>Update data to:</h2>
            <form action="updateData/updateDataHome.php" method="post" class="form-horizontal">
                <fieldset>
                    <select class="form-control" name="table" id="table">
                        <option>Admin</option>
                        <option>Speciality</option>
                        <option>Agent</option>
                        <option>Target</option>
                        <option>Contact</option>
                        <option>SafeHouse</option>
                        <option>Mission</option>
                    </select>
                    <button type="submit" class="restyle-btn btn btn-info">See</button>
                </fieldset>
            </form>
        </div>
        <div class="box box4">
            <h2>Delete data to:</h2>
            <form action="deleteData/deleteDataHome.php" method="post" class="form-horizontal">
                <fieldset>
                    <select class="form-control" name="table" id="table">
                        <option>Admin</option>
                        <option>Speciality</option>
                        <option>Agent</option>
                        <option>Target</option>
                        <option>Contact</option>
                        <option>SafeHouse</option>
                        <option>Mission</option>
                    </select>
                    <button type="submit" class="restyle-btn btn btn-info">See</button>
                </fieldset>
            </form>
        </div>
</main>

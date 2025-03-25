<?php
include_once('./_common.php');
if (!defined('_GNUBOARD_')) exit;
$g5['title'] = '30일 다이어트 플래너';
include_once(G5_PATH.'/head.php');
?>


<div class="diet-planner-container">
    <!-- Initial Setup Form -->
    <div class="setup-form">
        <h2>기초 정보 입력</h2>
        <form id="userInfoForm">
            <div class="form-group">
                <label for="height">신장</label>
                <input type="number" id="height" step="0.1" required>
                <select id="heightUnit">
                    <option value="cm">cm</option>
                    <option value="in">inch</option>
                </select>
            </div>
            <div class="form-group">
                <label for="weight">체중</label>
                <input type="number" id="weight" step="0.1" required>
                <select id="weightUnit">
                    <option value="kg">kg</option>
                    <option value="lb">lb</option>
                </select>
            </div>    
            <div class="form-group">
                <label for="targetWeight">목표 체중</label>
                <input type="number" id="targetWeight" step="0.1" required>
                <select id="targetWeightUnit">
                    <option value="kg">kg</option>
                    <option value="lb">lb</option>
                </select>
            </div>
            <button type="submit">시작하기</button>
        </form>
        <button id="resetPlanner" class="reset-button">초기화(다시 첫날부터 시작하기)</button>
    </div>

    <!-- Calendar View -->
    <div class="calendar-container">
        <h2>30일 진행 현황</h2>
        <div id="dietCalendar"></div>
    </div>

    <!-- Daily Plan -->
    <div class="daily-plan">
        <h2>오늘의 플랜</h2>
        <div class="meal-plan">
            <h3>추천 식단</h3>
            <div id="mealRecommendations"></div>
        </div>
        <div class="exercise-plan">
            <h3>추천 운동</h3>
            <div id="exerciseRecommendations"></div>
            <!--<h4>다른 운동 옵션</h4>-->
            <div id="otherExercises" class="other-exercises"></div>
        </div>
        <div class="weight-input">
            <h3>오늘의 최종 체중 기록</h3>
            <div class="weight-input-form">
                <input type="number" id="dailyWeight" step="0.1" placeholder="최종 체중을 입력하세요">
                <button id="saveWeight">저장</button>
            </div>
        </div>
    </div>
</div>

<style>
.diet-planner-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.setup-form, .daily-plan {
    background: #ffffff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    margin-bottom: 30px;
}

.setup-form h2 {
    color: #2c3e50;
    font-size: 24px;
    margin-bottom: 20px;
    padding-left: 15px;
    border-left: 5px solid #3498db;
}

.form-group {
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
}

.form-group label {
    color: #34495e;
    font-size: 16px;
    min-width: 100px;
}

.form-group input {
    flex: 1;
    min-width: 150px;
    padding: 12px 15px;
    border: 2px solid #e1e8ed;
    border-radius: 8px;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

.form-group input:focus {
    outline: none;
    border-color: #3498db;
}

.form-group select {
    padding: 12px;
    border: 2px solid #e1e8ed;
    border-radius: 8px;
    font-size: 16px;
    background: #fff;
}

#userInfoForm button[type="submit"] {
    width: 100%;
    padding: 12px 30px;
    background: #3498db;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 20px;
}

#userInfoForm button[type="submit"]:hover {
    background: #2980b9;
}

@media (max-width: 768px) {
    .form-group {
        flex-direction: column;
        align-items: stretch;
    }

    .form-group label {
        margin-bottom: 8px;
    }

    .form-group input,
    .form-group select {
        width: 100%;
    }

    .diet-planner-container {
        padding: 10px;
    }
}


.calendar-container {
    background: #ffffff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    margin-top: 30px;
}

.calendar-container h2 {
    color: #2c3e50;
    font-size: 24px;
    margin-bottom: 20px;
    padding-left: 15px;
    border-left: 5px solid #3498db;
}

.meal-recommendations, .exercise-recommendations {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 20px;
    margin-top: 20px;
}



.meal, .exercise {
    background: #f5f5f5;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}


#dietCalendar {
    margin-top: 20px;
    height: 500px;
}

@media (max-width: 768px) {
    .meal-recommendations, .exercise-recommendations {
        grid-template-columns: 1fr;
    }
}

.reset-button {
    background-color: #ff4444;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    margin-top: 10px;
    cursor: pointer;
}

.reset-button:hover {
    background-color: #cc0000;    
}

.daily-plan {
    background: #fff;
    border-radius: 8px;
    padding: 30px;
    margin-bottom: 20px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.daily-plan h2 {
    color: #2c3e50;
    font-size: 28px;
    margin-bottom: 25px;
    text-align: center;
    border-bottom: 3px solid #3498db;
    padding-bottom: 10px;
}

.meal-plan, .exercise-plan {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
}

.meal-plan h3, .exercise-plan h3 {
    color: #2c3e50;
    font-size: 24px;
    margin-bottom: 20px;
    padding-left: 15px;
    border-left: 5px solid #3498db;
}

.meal, .exercise {
    background: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    border: 1px solid #e1e8ed;
    transition: transform 0.2s ease;
}

.meal:hover, .exercise:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.meal h4, .exercise h4 {
    color: #34495e;
    font-size: 20px;
    margin-bottom: 15px;
}

.meal p, .exercise p {
    color: #576574;
    font-size: 16px;
    margin: 8px 0;
}

.other-meals {
    margin-top: 15px;
    padding: 10px;
    background: #f9f9f9;
    border-radius: 6px;
    display: none; /* Hide by default */
}

.toggle-options {
    background: #007bff;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 5px;
}

.toggle-options:hover {
    background: #0056b3;
}

.other-meal-item {
    padding: 8px;
    margin: 5px 0;
    background: #fff;
    border-radius: 4px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
}

.other-meal-item p {
    margin: 2px 0;
}
/*
.other-exercises {
    margin-top: 15px;
    padding: 15px;
    background: #f9f9f9;
    border-radius: 8px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 10px;
}

.other-exercise-item {
    padding: 10px;
    background: #fff;
    border-radius: 4px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
}
*/
.other-exercise-item {
    padding: 8px;
    margin: 5px 0;
    background: #fff;
    border-radius: 4px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
}

.other-exercise-item h5 {
    font-size: 16px;
    margin: 2px 0;
    font-weight: normal;
}

.other-exercise-item p {
    margin: 2px 0;
    color: #576574;
    font-size: 16px;
}

.weight-input {
    background: #ffffff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    margin-top: 30px;
}

.weight-input h3 {
    color: #2c3e50;
    font-size: 24px;
    margin-bottom: 20px;
    padding-left: 15px;
    border-left: 5px solid #3498db;
}

.weight-input-form {
    display: flex;
    gap: 15px;
    align-items: center;
    flex-wrap: wrap;
}

#dailyWeight {
    flex: 1;
    min-width: 200px;
    padding: 12px 15px;
    border: 2px solid #e1e8ed;
    border-radius: 8px;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

#dailyWeight:focus {
    outline: none;
    border-color: #3498db;
}

#saveWeight {
    padding: 12px 30px;
    background: #3498db;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

#saveWeight:hover {
    background: #2980b9;
}

@media (max-width: 768px) {
    .weight-input {
        padding: 20px;
    }

    .weight-input-form {
        flex-direction: column;
    }

    #dailyWeight {
        width: 100%;
    }

    #saveWeight {
        width: 100%;
    }
}

</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

<script>
// Make toggleOptions globally available
function toggleOptions(id) {
        const element = document.getElementById(id);
        if (!element) return;
        const button = element.previousElementSibling;
        if (element.style.display === 'none' || !element.style.display) {
            element.style.display = 'block';
            button.textContent = '다른 옵션 닫기';
        } else {
            element.style.display = 'none';
            button.textContent = '다른 옵션 보기';
        }
    }

    let calendar; // Add this at the top of your script
document.addEventListener('DOMContentLoaded', function() {    
    let plannerData = localStorage.getItem('dietPlannerData') ? 
        JSON.parse(localStorage.getItem('dietPlannerData')) : {
            userInfo: {},
            dailyRecords: {},
            targetWeight: null
        };
    
    //reset functionality
    document.getElementById('resetPlanner').addEventListener('click', function() {
    if (confirm('모든 데이터가 삭제됩니다. 정말 초기화하시겠습니까?')) {
        localStorage.removeItem('dietPlannerData');
        plannerData = {
            userInfo: {},
            dailyRecords: {},
            targetWeight: null
        };
        
        // Reset form fields
        document.getElementById('height').value = '';
        document.getElementById('weight').value = '';
        document.getElementById('targetWeight').value = '';
        document.getElementById('dailyWeight').value = '';
        
        // Update UI immediately
        calendar.removeAllEvents();
        updateCalendar();
        updateRecommendations();
    }
});
        
    // Unit conversion functions
    function kgToLbs(kg) {
        return kg * 2.20462;
    }

    function lbsToKg(lbs) {
        return lbs / 2.20462;
    }

    // Meal recommendations database
    const mealDatabase = {
    breakfast: [
        { name: '오트밀과 과일', calories: 300, protein: '10g', carbs: '45g', fat: '8g' },
        { name: '그릭요거트와 견과류', calories: 250, protein: '15g', carbs: '20g', fat: '12g' },
        { name: '계란 토스트', calories: 350, protein: '18g', carbs: '35g', fat: '14g' },
        { name: '통밀빵 샌드위치', calories: 320, protein: '12g', carbs: '48g', fat: '10g' },
        { name: '단백질 스무디', calories: 280, protein: '20g', carbs: '30g', fat: '8g' },
        { name: '과일 팬케이크', calories: 330, protein: '8g', carbs: '52g', fat: '12g' },
        { name: '채소 오믈렛', calories: 340, protein: '22g', carbs: '15g', fat: '24g' },
        { name: '연어 베이글', calories: 400, protein: '25g', carbs: '45g', fat: '16g' },
        { name: '아보카도 토스트', calories: 290, protein: '8g', carbs: '28g', fat: '18g' },
        { name: '고구마 샐러드', calories: 260, protein: '6g', carbs: '48g', fat: '6g' },
        { name: '북엇국과 현미밥', calories: 320, protein: '22g', carbs: '45g', fat: '8g' },
        { name: '콩나물국밥', calories: 280, protein: '15g', carbs: '42g', fat: '6g' },
        { name: '야채죽', calories: 250, protein: '8g', carbs: '48g', fat: '4g' },
        { name: '견과류 요거트볼', calories: 310, protein: '12g', carbs: '40g', fat: '14g' },
        { name: '연두부 샐러드', calories: 220, protein: '18g', carbs: '15g', fat: '12g' },
        { name: '호밀빵 샌드위치', calories: 340, protein: '14g', carbs: '50g', fat: '12g' },
        { name: '단호박 죽', calories: 280, protein: '6g', carbs: '52g', fat: '8g' },
        { name: '닭가슴살 샐러드', calories: 290, protein: '32g', carbs: '18g', fat: '10g' }
    ],
    lunch: [
        { name: '닭가슴살 샐러드', calories: 400, protein: '35g', carbs: '25g', fat: '15g' },
        { name: '현미밥과 생선구이', calories: 450, protein: '30g', carbs: '55g', fat: '12g' },
        { name: '퀴노아 볼', calories: 380, protein: '15g', carbs: '45g', fat: '18g' },
        { name: '잡곡밥과 두부구이', calories: 420, protein: '22g', carbs: '65g', fat: '10g' },
        { name: '참치 샐러드 랩', calories: 350, protein: '28g', carbs: '35g', fat: '14g' },
        { name: '채소 비빔밥', calories: 430, protein: '20g', carbs: '70g', fat: '12g' },
        { name: '렌틸콩 카레', calories: 440, protein: '18g', carbs: '62g', fat: '14g' },
        { name: '닭고기 팟타이', calories: 480, protein: '32g', carbs: '58g', fat: '16g' },
        { name: '연어포케', calories: 420, protein: '28g', carbs: '40g', fat: '20g' },
        { name: '병아리콩 샐러드', calories: 350, protein: '15g', carbs: '45g', fat: '12g' },
        { name: '된장찌개와 현미밥', calories: 400, protein: '25g', carbs: '55g', fat: '12g' },
        { name: '순두부찌개', calories: 350, protein: '22g', carbs: '35g', fat: '16g' },
        { name: '김치찌개', calories: 380, protein: '20g', carbs: '40g', fat: '18g' },
        { name: '비빔국수', calories: 420, protein: '15g', carbs: '68g', fat: '12g' },
        { name: '쌈밥 정식', calories: 450, protein: '22g', carbs: '65g', fat: '15g' },
        { name: '낙지볶음', calories: 380, protein: '35g', carbs: '25g', fat: '18g' },
        { name: '닭갈비', calories: 460, protein: '38g', carbs: '35g', fat: '22g' },
        { name: '콩나물밥', calories: 350, protein: '12g', carbs: '62g', fat: '8g' }
    ],
    dinner: [
        { name: '두부 스테이크', calories: 350, protein: '25g', carbs: '20g', fat: '20g' },
        { name: '연어 샐러드', calories: 400, protein: '30g', carbs: '15g', fat: '25g' },
        { name: '닭가슴살 스튜', calories: 380, protein: '35g', carbs: '25g', fat: '15g' },
        { name: '돼지고기 부침과 야채', calories: 420, protein: '32g', carbs: '30g', fat: '22g' },
        { name: '콩고기 버거', calories: 330, protein: '20g', carbs: '45g', fat: '12g' },
        { name: '해산물 파스타', calories: 450, protein: '25g', carbs: '65g', fat: '15g' },
        { name: '칠리 콘 카르네', calories: 420, protein: '28g', carbs: '35g', fat: '20g' },
        { name: '닭고기 케밥', calories: 380, protein: '32g', carbs: '30g', fat: '18g' },
        { name: '버섯 리조또', calories: 400, protein: '12g', carbs: '65g', fat: '14g' },
        { name: '고등어구이', calories: 350, protein: '28g', carbs: '10g', fat: '24g' },
        { name: '삼겹살과 쌈', calories: 450, protein: '30g', carbs: '25g', fat: '28g' },
        { name: '불고기와 잡곡밥', calories: 420, protein: '28g', carbs: '50g', fat: '16g' },
        { name: '제육볶음', calories: 380, protein: '25g', carbs: '35g', fat: '20g' },
        { name: '오징어볶음', calories: 340, protein: '32g', carbs: '25g', fat: '16g' },
        { name: '닭볶음탕', calories: 420, protein: '35g', carbs: '30g', fat: '22g' },
        { name: '연어덮밥', calories: 450, protein: '28g', carbs: '55g', fat: '18g' },
        { name: '소고기 미역국', calories: 320, protein: '25g', carbs: '30g', fat: '15g' },
        { name: '두부김치', calories: 280, protein: '18g', carbs: '25g', fat: '14g' }
    ]
};

    // Exercise recommendations database
    const exerciseDatabase = [
        { name: '걷기(200kcal/hour)', caloriesPerHour: 200, duration: 30 },
        { name: '당구(170kcal/hour)', caloriesPerHour: 170, duration: 60 },
        { name: '볼링(216kcal/hour)', caloriesPerHour: 216, duration: 60 },
        { name: '탁구(270kcal/hour)', caloriesPerHour: 270, duration: 30 },
        { name: '복싱(700kcal/hour)', caloriesPerHour: 700, duration: 45 },
        { name: '배드민턴(450kcal/hour)', caloriesPerHour: 450, duration: 60 },
        { name: '줄넘기(650kcal/hour)', caloriesPerHour: 650, duration: 30 },
        { name: '등산(500kcal/hour)', caloriesPerHour: 500, duration: 60 },
        { name: '골프(280kcal/hour)', caloriesPerHour: 280, duration: 240 },
        { name: '조깅(400kcal/hour)', caloriesPerHour: 400, duration: 30 },
        { name: '수영(500kcal/hour)', caloriesPerHour: 500, duration: 30 },
        { name: '라인댄스(350kcal/hour)', caloriesPerHour: 350, duration: 50 },
        { name: '자전거(450kcal/hour)', caloriesPerHour: 450, duration: 30 },
        { name: '에어로빅(450kcal/hour)', caloriesPerHour: 450, duration: 50 },
        { name: '축구(600kcal/hour)', caloriesPerHour: 600, duration: 90 },
        { name: '야구(300kcal/hour)', caloriesPerHour: 300, duration: 120 },
        { name: '농구(500kcal/hour)', caloriesPerHour: 500, duration: 60 },
        { name: '홈트레이닝(350kcal/hour)', caloriesPerHour: 350, duration: 30 }
    ];
    
        // Sort meals alphabetically
        Object.keys(mealDatabase).forEach(mealTime => {
        mealDatabase[mealTime].sort((a, b) => a.name.localeCompare(b.name, 'ko'));
        });

        // Sort exercises alphabetically
        exerciseDatabase.sort((a, b) => a.name.localeCompare(b.name, 'ko'));

    //calculateDailyCalorieDeficit function
    function calculateDailyCalorieDeficit() {
        if (!plannerData.userInfo.weight || !plannerData.targetWeight) return 500; // default deficit

        const currentWeight = parseFloat(plannerData.userInfo.weight.value);
        const targetWeight = parseFloat(plannerData.targetWeight.value);
        const totalWeightLoss = currentWeight - targetWeight;
        
        // Convert to kg if needed
        const weightLossKg = plannerData.userInfo.weight.unit === 'lb' ? totalWeightLoss * 0.45359237 : totalWeightLoss;
        
        // Calculate daily deficit (1kg fat = 7700 calories, spread over 30 days)
        const totalCaloriesNeeded = weightLossKg * 7700;
        const dailyDeficit = Math.round(totalCaloriesNeeded / 30);

        // Limit deficit to safe range (500-1000 calories per day)
        return Math.min(Math.max(dailyDeficit, 500), 1000);
    }

    function getRandomMeals() {
        const dailyDeficit = calculateDailyCalorieDeficit();
        const baseCalories = 2000 - dailyDeficit; // Adjust base calories according to deficit
        
        // Distribute calories: 30% breakfast, 40% lunch, 30% dinner
        const breakfastCal = Math.round(baseCalories * 0.3);
        const lunchCal = Math.round(baseCalories * 0.4);
        const dinnerCal = Math.round(baseCalories * 0.3);

        // Filter meals based on calorie targets
        const getClosestMeal = (meals, targetCal) => {
            return meals.reduce((prev, curr) => {
                return Math.abs(curr.calories - targetCal) < Math.abs(prev.calories - targetCal) ? curr : prev;
            });
        };

        return {
            breakfast: getClosestMeal(mealDatabase.breakfast, breakfastCal),
            lunch: getClosestMeal(mealDatabase.lunch, lunchCal),
            dinner: getClosestMeal(mealDatabase.dinner, dinnerCal)
        };
    }


    function getRandomExercises(count = 2) {
        const dailyDeficit = calculateDailyCalorieDeficit();
        const targetExerciseCalories = Math.round(dailyDeficit * 0.5); // 50% of deficit from exercise
        
        const shuffled = [...exerciseDatabase].sort(() => 0.5 - Math.random());
        const selected = shuffled.slice(0, count);
        
        // Adjust duration to meet calorie target
        return selected.map(exercise => ({
            ...exercise,
            duration: Math.round((targetExerciseCalories / count) * (60 / exercise.caloriesPerHour))
        }));
    }
        

    function updateRecommendations() {
        const meals = getRandomMeals();
        const exercises = getRandomExercises(2);

        const mealHtml = `
        <div class="meal-recommendations">
            <div class="meal">
                <h4>아침</h4>
                <p>${meals.breakfast.name}</p>
                <p>칼로리: ${meals.breakfast.calories}kcal</p>
                <button type="button" class="toggle-options" onclick="window.toggleOptions('breakfast-options')">다른 옵션 보기</button>
                <div id="breakfast-options" class="other-meals">
                    ${mealDatabase.breakfast
                        .filter(meal => meal.name !== meals.breakfast.name)
                        .map(meal => `
                            <div class="other-meal-item">
                                <p>${meal.name}</p>
                                <p>칼로리: ${meal.calories}kcal</p>
                            </div>
                        `).join('')}
                </div>
            </div>
            <div class="meal">
                <h4>점심</h4>
                <p>${meals.lunch.name}</p>
                <p>칼로리: ${meals.lunch.calories}kcal</p>
                <button type="button" class="toggle-options" onclick="window.toggleOptions('lunch-options')">다른 옵션 보기</button>
                <div id="lunch-options" class="other-meals">
                    ${mealDatabase.lunch
                        .filter(meal => meal.name !== meals.lunch.name)
                        .map(meal => `
                            <div class="other-meal-item">
                                <p>${meal.name}</p>
                                <p>칼로리: ${meal.calories}kcal</p>
                            </div>
                        `).join('')}
                </div>
            </div>
            <div class="meal">
                <h4>저녁</h4>
                <p>${meals.dinner.name}</p>
                <p>칼로리: ${meals.dinner.calories}kcal</p>
                <button type="button" class="toggle-options" onclick="window.toggleOptions('dinner-options')">다른 옵션 보기</button>
                <div id="dinner-options" class="other-meals">
                    ${mealDatabase.dinner
                        .filter(meal => meal.name !== meals.dinner.name)
                        .map(meal => `
                            <div class="other-meal-item">
                                <p>${meal.name}</p>
                                <p>칼로리: ${meal.calories}kcal</p>
                            </div>
                        `).join('')}
                </div>
            </div>
        </div>
    `;

    const exerciseHtml = exercises.map(exercise => `
        <div class="exercise">
            <h4>${exercise.name}</h4>
            <p>${exercise.duration}분</p>
            <p>소모 칼로리: ${Math.round(exercise.caloriesPerHour * (exercise.duration/60))}kcal</p>
        </div>
    `).join('');

    // Add toggle button before other exercises
    const selectedExerciseNames = exercises.map(e => e.name);
    const otherExercisesSection = `
        <button type="button" class="toggle-options" onclick="window.toggleOptions('other-exercises-options')">다른 옵션 보기</button>
        <div id="other-exercises-options" class="other-exercises" style="display: none;">
            ${exerciseDatabase
                .filter(exercise => !selectedExerciseNames.includes(exercise.name))
                .map(exercise => `
                    <div class="other-exercise-item">
                        <h5>${exercise.name}</h5>
                        <p>기본 시간: ${exercise.duration}분</p>
                        <p>소모 칼로리: ${Math.round(exercise.caloriesPerHour * (exercise.duration/60))}kcal</p>
                    </div>
                `).join('')}
        </div>
    `;

    document.getElementById('mealRecommendations').innerHTML = mealHtml;
    document.getElementById('exerciseRecommendations').innerHTML = exerciseHtml;
    document.getElementById('otherExercises').innerHTML = otherExercisesSection;

    // Create other exercises HTML
    /*
    const selectedExerciseNames = exercises.map(e => e.name);
    const otherExercisesHtml = exerciseDatabase
        .filter(exercise => !selectedExerciseNames.includes(exercise.name))
        .map(exercise => `
            <div class="other-exercise-item">
                <h5>${exercise.name}</h5>
                <p>기본 시간: ${exercise.duration}분</p>
                <p>소모 칼로리: ${Math.round(exercise.caloriesPerHour * (exercise.duration/60))}kcal</p>
            </div>
        `).join('');    
    document.getElementById('mealRecommendations').innerHTML = mealHtml;
    document.getElementById('exerciseRecommendations').innerHTML = exerciseHtml;
    document.getElementById('otherExercises').innerHTML = otherExercisesHtml;
    */
}   


    function initializeCalendar() {
        const calendarEl = document.getElementById('dietCalendar');
        calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,listMonth'
        },
        events: function(info, successCallback) {
            const events = [];
            Object.entries(plannerData.dailyRecords).forEach(([date, record]) => {
                if (record.weight) {
                    events.push({
                        title: `체중: ${record.weight}${plannerData.userInfo.weight?.unit || 'kg'}`,
                        date: date,
                        backgroundColor: '#4CAF50'
                    });
                }
            });
            successCallback(events);
        }
    });
    calendar.render();
}

    // Initialize the planner
    initializeCalendar();
    updateRecommendations();


    // Save data to localStorage
    function saveData() {
        localStorage.setItem('dietPlannerData', JSON.stringify(plannerData));
    }

    // Handle form submission
    document.getElementById('userInfoForm').addEventListener('submit', function(e) {
        e.preventDefault();
        plannerData.userInfo = {
            height: {
                value: document.getElementById('height').value,
                unit: document.getElementById('heightUnit').value
            },
            weight: {
                value: document.getElementById('weight').value,
                unit: document.getElementById('weightUnit').value
            },
            startDate: new Date().toISOString()
        };
        plannerData.targetWeight = {
            value: document.getElementById('targetWeight').value,
            unit: document.getElementById('targetWeightUnit').value
        };
        saveData();
        updateCalendar();
        updateRecommendations();
    });

    // Save daily weight
    document.getElementById('saveWeight').addEventListener('click', function() {
        const today = new Date().toISOString().split('T')[0];
        const weight = document.getElementById('dailyWeight').value;
        
        if (!plannerData.dailyRecords[today]) {
            plannerData.dailyRecords[today] = {};
        }
        plannerData.dailyRecords[today].weight = weight;
        saveData();
        updateCalendar();
    });

    function updateCalendar() {
    if (calendar) {
        calendar.refetchEvents();
    }
}

    // Initial calendar update
    updateCalendar();
});
</script>

<?php
include_once(G5_PATH.'/tail.php');
?>
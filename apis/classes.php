<?php

	class API{

		public function login($data){

			$m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
			$db=$m->argot;
			$collection=$db->user;

			$cursor=$collection->findOne(array('email' => $data['email'], 'password' => $data['password']));

				if ($cursor) {
					return $cursor;
				}else{
					return 0;
				}
		}

		public function register($data){

			$m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
			$db=$m->argot;
			$collection=$db->user;

			$cursor=$collection->findOne(array('institute'=>$data['institute']));

			if ($cursor) {
				return 0;
			}
			$insert=$collection->insert($data);
			return 1;
		}

		public function retrieveAllTeacher($data){

			$m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
			$db=$m->argot;
			$collection=$db->user;

			$institute=$data['institute'];
			$cursor=$collection->find(array('role'=>'teacher','institute'=>$institute));

			if ($cursor) {
				return $cursor;
			}else{
				return 0;
			}

		}

		public function editTeacher($data){

			$m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
			$db=$m->argot;
			$collection=$db->user;
		
			$update=$collection->update(array('id'=>$data['id']),array('$set'=>$data),array('upsert'=>'true'));
			if ($update) {
				return 1;
			}return 0;
		}
		
		public function removeTeacher($data){

			$m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
			$db=$m->argot;
			$collection=$db->user;

			$delete=$collection->remove(array('id'=>$data['id']));
			if ($delete) {
				return 1;
			}return 0;
		}


		public function retrieveTeacher($data){
			
			$m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
			$db=$m->argot;
			$collection=$db->user;

			$cursor=$collection->findOne(array('id' => $data['id']));

			if ($cursor) {
				return $cursor;
			}
			return 0;
		}

		public function addTeacher($data){
			
			$m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
			$db=$m->argot;
			$collection=$db->user;

			$cursor=$collection->findOne(array('id' => $data['id'] ));
			
			if ($cursor) {
				return 0;
			}

			$insert=$collection->insert($data);
			return 1;
		}


		public function assignexam($data){

			$m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
			$db=$m->argot;
			$collection=$db->examdetails;

			$cursor=$collection->findOne(array('id' => $data['id']));
			
			if ($cursor) {
				return 0;
			}

			$insert=$collection->insert($data);
			return 1;
		}

		public function retrieveClass($data)
		{
			$m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
			$db=$m->argot;
			$collection=$db->class;

            $cursor=$collection->find(array('institute'=>$data['institute']));

            if($cursor){
                return $cursor;
            }else{
                return 0;
            }
		}

		public function addClass($data)
		{
			$m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->class;

            $cursor=$collection->findOne(array('class'=>$data['class']));

            if($cursor){
                return 0;
            }else{
                $collection->insert($data);
                return 1;
            }
		}

        public function removeClass($data)
        {

            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->class;
            $collection1=$db->student;

            $delete=$collection->remove(array('class'=>$data['class']));

            $studentremove=$collection1->remove(array('class'=>$data['class']));
            if ($delete and $studentremove) {
                return 1;
            }return 0;
        }

        public function retrieveStudent($data)
        {
            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->student;

            $cursor=$collection->find(array('institute'=>$data['institute']));

            if($cursor){
                return $cursor;
            }else{
                return 0;
            }
        }

        public function addStudent($data)
        {
            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->student;

            $cursor=$collection->findOne(array('id'=>$data['id'],'email'=>$data['email']));

            if($cursor){
                return 0;
            }else{
                $insert=$collection->insert($data);
                return 1;
            }
        }

        public function removeStudent($data)
        {
            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->student;

            $delete=$collection->remove(array('id'=>$data['id']));
            if ($delete) {
                return 1;
            }return 0;
        }

        public function retrieveOneStudent($data){

            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->student;

            $cursor=$collection->findOne(array('id' => $data['id']));

            if ($cursor) {
                return $cursor;
            }
            return 0;
        }

        public function editStudent($data)
        {
            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->student;

            $update=$collection->update(array('id'=>$data['id']),array('$set'=>$data),array('upsert'=>'true'));

            if ($update) {
                return 1;
            }return 0;
        }

        public function retrieveExams($data)
        {
            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->exam;

            $exam=$collection->find(array('institute'=>$data['institute'],'teacher_id'=>$data['id']));

            if($exam){
                return $exam;
            }else{
                return 0;
            }
        }

        public function retrieveOneExam($data){
            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->exam;

            $exam=$collection->findOne(array('id'=>$data['id']));

            if($exam){
                return $exam;
            }else{
                return 0;
            }
        }
		public function addExam($data){

            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->exam;

            $cursor=$collection->findOne(array('id'=>$data['id']));

            if($cursor){
                return 0;
            }
            $exam=$collection->insert($data);
            return 1;
        }

        public function addNotification($data){

            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->notification;

            $id=time().rand(1,1000);
            $data['_id']=$id;
            $data['status']='unread';
            $notification=$collection->insert($data);
            return 1;
        }

        public function sendNotification($data,$type){

            $notifid=time().rand(1,1000);
            $send=array('id'=>$notifid,'title'=>$data['title'],'url'=>$data['url'],'message'=>$data['message'],'institute'=>$data['institute'],'date'=>$data['date'],'time'=>time());

            if($type=='student'){
                $send['class']=$data['class'];
                $send['receiver']='student';
            }elseif($type=='teacher'){
                $send['teacher_id']=$data['teacher_id'];
                $send['receiver']='teacher';
            }
            $result=$this->addNotification($send);

            return $result;
        }

        public function classNotify($data){

            $id=$data['id'];
            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->exam;

            $update=$collection->update(array('id'=>$id),array('$set'=>array('notify'=>'yes')),array('upsert'=>'true'));
            if($update){
                return 1;
            }else{
                return 0;
            }
        }

        public function addQuestion($data){

            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->questionBank;

            $repeat=$collection->findOne(array('question'=>$data['question']));

            if($repeat){
                return 0;
            }

            $addQuestion=$collection->insert($data);
            return 1;
        }

        public function updateExamStatus($data){

            $id=$data['id'];
            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->exam;

            $update=$collection->update(array('id'=>$id),array('$set'=>array('status'=>1)),array('upsert'=>'true'));

        }

        public function retrieveExamStatus($data){

            $id=$data['id'];
            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->exam;

            $status=$collection->findOne(array('id'=>$data['id']));

            if($status['status']==1){
                return 1;
            }else{
                return 0;
            }
        }

        public function retrievePendingExams(){

            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->exam;

            $pendingExams=$collection->find(array('status'=>'0'));

            return $pendingExams->count();
        }

        public function StudentLogin($data){

            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->student;

            $cursor=$collection->findOne(array('email' => $data['email'], 'password' => $data['password']));

            if ($cursor) {
                return $cursor;
            }else{
                return 0;
            }
        }

        public function retrieveTeacherNotification($data){

            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->notification;

            $cursor=$collection->find(array('teacher_id'=>$data['id'],'receiver'=>'teacher','institute'=>$data['institute']));

            if($cursor){
                return $cursor->sort(array('time'=>-1))->limit(5);
            }return 0;
        }

        public function retrieveAllTeacherNotification($data){

            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->notification;

            $cursor=$collection->find(array('teacher_id'=>$data['id'],'receiver'=>'teacher','institute'=>$data['institute']));

            if($cursor){
                return $cursor->sort(array('time'=>-1));
            }return 0;
        }

        public function retrieveStudentNotification($data){

            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->notification;

            $cursor=$collection->find(array('class'=>$data['class'],'receiver'=>'student','institute'=>$data['institute']));

            if($cursor){
                return $cursor->sort(array('time'=>-1))->limit(5);
            }return 0;
        }

        public function retrieveAllStudentNotification($data){

            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->notification;

            $cursor=$collection->find(array('class'=>$data['class'],'receiver'=>'student','institute'=>$data['institute']));

            if($cursor){
                return $cursor->sort(array('time'=>-1));
            }return 0;
        }

        public function detectExam(){

            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->exam;

            $date=date('Y-m-d',time());

            $cursor=$collection->find(array('date'=>$date,'notify'=>'yes','status'=>1));

            if($cursor){
                return $cursor;
            }else{
                return 0;
            }
        }

        public function validateExam($data){

            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->exam;

            $date=date('Y-m-d',time());

            $cursor=$collection->findOne(array('date'=>$date,'notify'=>'yes','status'=>1,'_id'=>$data['id']));

            if($cursor){
                return $cursor;
            }else{
                return 0;
            }
        }

        public function retrieveQuestionBank($data){

            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->questionBank;

            $cursor=$collection->find(array('id'=>$data['id']));

            if($cursor){
                return $cursor;
            }else{
                return 0;
            }
        }

        public function retrieveQuestion($data){

            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->questionBank;

            $cursor=$collection->findOne(array('_id'=>$data['id']));

            if($cursor){
                return $cursor;
            }else{
                return 0;
            }
        }

        public function startExam($data)
        {
            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->examSession;

            $sessionId=md5(sha1($data['id'].time()));
            $status=0;

            $data['status']=$status;
            $data['time']=time();
            $data['sessionId']=$sessionId;
            $session=$collection->insert($data);

            if($session){
                return $data;
            }else{
                return 0;
            }

        }

        public function firstQuestion($data){

            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->questionBank;

            $cursor=$collection->findOne(array('id'=>$data['id']));

            if($cursor){
                return $cursor;
            }else{
                return 0;
            }
        }

        public function finishExam()
        {
            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->examSession;

            $status=$collection->update(array('sessionId'=>$_SESSION['exam']['sessionId']),array('$set'=>array('status'=>1)),array('upsert'=>true));
            unset($_SESSION['exam']);
            return 1;
        }

        public function displayAppeared($data){

            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->examSession;

            $status=$collection->findOne(array('id'=>$data['id'],'student'=>$data['student']));

            if ($status['status']==1) {

                return 1;

            }return 0;
        }

        public function addAnswer($data){

            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->answerBank;



            $add=$collection->insert($data);

            if($add){
                return 1;
            }else{
                return 0;
            }

        }

        public function ifAnswered($data){

            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->answerBank;

            $status=$collection->findOne(array('id'=>$data['id'],'student_id'=>$data['student_id'],'question_id'=>$data['question_id']));

            if($status){
                return $status;
            }else{
                return 0;
            }
        }

        public function updateAnswer($data)
        {
            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->answerBank;

            $update=$collection->update(array('id'=>$data['id'],'student_id'=>$_SESSION['client']['id'],'question_id'=>$data['question_id']),array('$set'=>array('student_answer'=>$data['answer'])),array('upsert'=>'true'));
            return 1;
        }

        public function hasAttended(){

            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->examSession;

            $cursor=$collection->find();

            if($cursor){
                return $cursor;
            }else{
                return 0;
            }
        }

        public function retrieveSubject($data){

            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->exam;

            $cursor=$collection->findOne(array('id'=>$data['id']));

            if($cursor){
                return $cursor;
            }else{
                return 0;
            }
        }

        public function generateReport($data)
        {
            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->answerBank;

            $cursor=$collection->find(array('id'=>$data['id'],'student_id'=>$data['student_id']));

            if($cursor){
                return $cursor;
            }else{
                return 0;
            }

        }

        public function removeExam($data)
        {


            $m=new MongoClient("mongodb://argot:dpsnoida30@ds035260.mongolab.com:35260/argot");
            $db=$m->argot;
            $collection=$db->exam;

            $delete=$collection->remove(array('id'=>$data['class']));

            if ($delete) {
                return 1;
            }return 0;

        }

    }

?>
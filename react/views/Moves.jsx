import React, { useState } from 'react'

export default function Moves() {

  const [idNum, setIdNum] = useState([]);

  const searchIdNum = (e) => {
    e.preventDefault();

    console.log("Search");
  }
  return (
    <div>
      <div className='flex justify-center mt-10 '>
        <div className='flex flex-col'>
          <form onSubmit={searchIdNum} action="" className='flex flex-col items-center border p-10'>
            <label htmlFor="idnum" className='text-2xl'>Sifra</label>
            <input type="text" className='border px-7'/>
            <button className='mt-10 border rounded-xl px-7 py-2 hover:bg-green-700 hover:text-white'>Pretrazi</button>
          </form>
        </div>
      </div>
    </div>
  )
}

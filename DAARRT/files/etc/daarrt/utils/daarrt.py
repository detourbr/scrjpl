#!/usr/bin/python

import os
import struct
# import sys

def high_low_int(high_byte, low_byte):
    '''
    Convert low and low and high byte to int
    '''
    return (high_byte << 8) + low_byte

def high_byte(integer):
    '''
    Get the high byte from a int
    '''
    return integer >> 8


def low_byte(integer):
    '''
    Get the low byte from a int
    '''
    return integer & 0xFF


def high_low_int(high_byte, low_byte):
    '''
    Convert low and low and high byte to int
    '''
    return (high_byte << 8) + low_byte

class Daarrt():
    def __init__(self, ):

        self.motor_last_change = 0

        if os.access("/var/www/daarrt.conf", os.F_OK) :
            print "Real DAARRT creation"

            # Import modules
            from trex.trexio import TrexIO

            self.trex = TrexIO(0x07)
            print self.status()
        else :
            print "Create virtual DAARRT"

            # Import modules
            # from trex.trexio import vTrexIO

    def status(self):
        '''
        Read status from trex
        Return as a byte array
        '''
        # answer = self.trex.i2c_read()
        # return map(ord, answer)
        raw_status = self.trex.i2cRead()
        return struct.unpack(">cchhhhhhhhhhh", raw_status)[2:]


    def reset(self):
        '''
        Reset the trex controller to default
        Stop dc motors...
        '''
        self.trex.reset()


    def motor(self, left, right):
        '''
        Set speed of the dc motors
        left and right can have the folowing values: -255 to 255
        -255 = Full speed astern
        0 = stop
        255 = Full speed ahead
        '''
        self.motor_last_change = time.time()*1000
        left = int(left)
        right = int(right)
        self.trex.package['lm_speed_high_byte'] = high_byte(left)
        self.trex.package['lm_speed_low_byte'] = low_byte(left)
        self.trex.package['rm_speed_high_byte'] = high_byte(right)
        self.trex.package['rm_speed_low_byte'] = low_byte(right)
        self.trex.i2cWrite()


    def servo(self, servo, position):
        '''
        Set servo position
        Servo = 1 to 6
        Position = Typically the servo position should be a value between 1000 and 2000 although it will vary depending on the servos used
        '''
        servo = str(servo)
        position = int(position)
        self.trex.package['servo_' + servo + '_high_byte'] = high_byte(position)
        self.trex.package['servo_' + servo + '_low_byte'] = low_byte(position)
        self.trex.i2cWrite()



# if __name__ == "__main__":
#     Daarrt()
